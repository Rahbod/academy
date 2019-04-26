<?php
namespace Appnegar\Cms\Traits;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

trait UserTrait
{
    //Big block of caching functionality.
    public function cachedRoles()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = 'roles_for_user_' . $this->$userPrimaryKey;
        return Cache::remember($cacheKey, Config::get('cache.ttl'), function () {
            return $this->roles()->get();
        });

    }

    public function save(array $options = [])
    {   //both inserts and updates
        Cache::forget($cacheKey = 'roles_for_user_' . $this->primaryKey);
        return parent::save($options);
    }

    public function delete(array $options = [])
    {   //soft or hard
        parent::delete($options);
        Cache::forget($cacheKey = 'roles_for_user_' . $this->primaryKey);
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('acl.role'), Config::get('acl.role_user_table'), Config::get('acl.user_foreign_key'), Config::get('acl.role_foreign_key'));
    }


    /**
     * Checks if the user has a role by its name.
     *
     * @param string|array $name Role name or array of role names.
     * @param bool $requireAll All roles in the array are required.
     *
     * @return bool
     */
    public function hasRole($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$requireAll) {
                    return true;
                } elseif (!$hasRole && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->cachedRoles() as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Check if user has a action by its name.
     *
     * @param integer|array $action_id Action id or array of action IDs.
     * @param bool $requireAll All actions in the array are required.
     *
     * @return bool
     */
    public function canDo($action_id,$requireAll=false)
    {
        if (is_array($action_id)){
            foreach ($action_id as $id) {
                $can_do = $this->canDo($id);
                if ($can_do && !$requireAll) {
                    return true;
                } elseif (!$can_do && $requireAll) {
                    return false;
                }
            }
            // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
            // Return the value of $requireAll;
            return $requireAll;
        }
        elseif(is_numeric($action_id)){
            foreach ($this->cachedRoles() as $role) {
                if ($role->hasAction($action_id)) {
                    return true;
                }
            }
        }

        return false;
    }
    

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->attach($role);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $role
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }

    /**
     * Attach multiple roles to a user
     *
     * @param mixed $roles
     */
    public function attachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * Detach multiple roles from a user
     *
     * @param mixed $roles
     */
    public function detachRoles($roles = null)
    {
        if (!$roles) $roles = $this->roles()->get();

        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

}
