<?php

namespace Appnegar\Cms\Models\Auth;
use App\User;
use Appnegar\Cms\Traits\UserTrait;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Notifications\Notifiable;

class SystemManagementGuard extends User
{
    use Notifiable;
    use UserTrait;
    use CausesActivity;

    protected $table='users';


    function __construct($attributes = []) {
        if($attributes) {
            $attributes['type'] = 'departments';
        }
        parent::__construct($attributes);

    }
    public function newQuery() {
        return parent::newQuery()->where('access_level',3)->whereHas('departments', function ($query) {
            $query->where('name', session('department'));
        });
    }

}