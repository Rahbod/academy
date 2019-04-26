<?php
namespace Appnegar\Cms\Traits;


use Illuminate\Support\Facades\Config;

trait ActionTrait
{
    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('acl.role'), Config::get('acl.action_role_table'));
    }

    /**
     * Boot the action model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the action model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($action) {
            if (!method_exists(Config::get('acl.action'), 'bootSoftDeletes')) {
                $action->roles()->sync([]);
            }

            return true;
        });
    }
}
