<?php
namespace Appnegar\Cms\Traits;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

trait RoleTrait
{
    //Big block of caching functionality.
    public function cachedActions()
    {

        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'actions_for_role_' . $this->$rolePrimaryKey;
        return Cache::remember($cacheKey, Config::get('cache.ttl'), function ()  {
            return $this->actions()->get();
        });
    }

    public function save(array $options = [])
    {   //both inserts and updates
        if (!parent::save($options)) {
            return false;
        }
        Cache::forget('actions_for_role_' . $this->primaryKey);
        return true;
    }

    public function delete(array $options = [])
    {   //soft or hard
        if (!parent::delete($options)) {
            return false;
        }
        Cache::forget('actions_for_role_' . $this->primaryKey);
        return true;
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('auth.providers.users.model'), Config::get('acl.role_user_table'), Config::get('acl.role_foreign_key'), Config::get('acl.user_foreign_key'));
    }

    /**
     * Many-to-Many relations with the action model.
     * Named "actions" for backwards compatibility. Also because "actions" is short and sweet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actions()
    {
        return $this->belongsToMany(Config::get('acl.action'), Config::get('acl.action_role_table'), Config::get('acl.role_foreign_key'), Config::get('acl.action_foreign_key'));
    }

    /**
     * Boot the role model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the role model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            if (!method_exists(Config::get('acl.role'), 'bootSoftDeletes')) {
                $role->users()->sync([]);
                $role->actions()->sync([]);
            }

            return true;
        });
    }

    /**
     * Checks if the role has a action by its name.
     *
     * @param integer|array $action_id Action id or array of action IDs.
     * @param bool $requireAll All actions in the array are required.
     *
     * @return bool
     */
    public function hasAction($action_id,$requireAll=false)
    {
        if(is_numeric($action_id))
        {
            foreach ($this->cachedActions() as $action) {
                if ($action->id == $action_id) {
                    return true;
                }
            }
        }
        elseif (is_array($action_id))
        {
            foreach ($action_id as $id)
            {
                $has_action=$this->hasAction($id);
                if ($has_action && !$requireAll) {
                    return true;
                } elseif (!$has_action && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the actions were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the actions were found.
            // Return the value of $requireAll;
            return $requireAll;
        }
        return false;
    }

    /**
     * Save the inputted actions.
     *
     * @param mixed $inputActions
     *
     * @return void
     */
    public function saveActions($inputActions)
    {
        if (!empty($inputActions)) {
            $this->actions()->sync($inputActions);
        } else {
            $this->actions()->detach();
        }

        Cache::forget('actions_for_role_' . $this->primaryKey);
    }

    /**
     * Attach action to current role.
     *
     * @param object|array $action
     *
     * @return void
     */
    public function attachAction($action)
    {
        if (is_object($action)) {
            $action = $action->getKey();
        }

        if (is_array($action)) {
            $this->attachActions($action);
        }

        $this->actions()->attach($action);
    }

    /**
     * Detach action from current role.
     *
     * @param object|array $action
     *
     * @return void
     */
    public function detachAction($action)
    {
        if (is_object($action)) {
            $action = $action->getKey();
        }

        if (is_array($action)) {
            $this->detachActions($action);
        }

        $this->actions()->detach($action);
    }

    /**
     * Attach multiple actions to current role.
     *
     * @param mixed $actions
     *
     * @return void
     */
    public function attachActions($actions)
    {
        foreach ($actions as $action) {
            $this->attachAction($action);
        }
        Cache::forget('actions_for_role_' . $this->primaryKey);
    }

    /**
     * Detach multiple actions from current role
     *
     * @param mixed $actions
     *
     * @return void
     */
    public function detachActions($actions = null)
    {
        if (!$actions) $actions = $this->actions()->get();

        foreach ($actions as $action) {
            $this->detachAction($action);
        }
    }
}
