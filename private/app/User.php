<?php

namespace App;

use Appnegar\Cms\Traits\GetImageAttributesTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Appnegar\Cms\Traits\UserTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable
{
    use Notifiable;
    use UserTrait;
    use ModelTrait;
    use LogsActivity;
    use GetImageAttributesTrait;

//    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'gender', 'password', 'avatar', 'type','is_admin', 'status', 'verified', 'verify_email_link', 'access_level', 'remember_token'
    ];

    protected $hidden = ['password', 'remember_token'];

    public static function mainFields(){
        return [
            'name' => static::getTableName(),
            'items' => [
                [
                    'name' => 'id',
                    'type' => 'numeric',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'username',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'email',
                    'type' => 'string',
                    'input_type' => 'email',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'password',
                    'type' => 'string',
                    'input_type' => 'password',
                    'orderable' => true,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'password_confirmation',
                    'type' => 'string',
                    'input_type' => 'password',
                    'is_table_field' => false,
                    'orderable' => true,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'avatar',
                    'type' => 'string',
                    'input_type' => 'image',
                    'orderable' => true,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'type',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 'admin', 'text' => 'admin'], ['id' => 'operator', 'text' => 'operator'], ['id' => 'teacher', 'text' => 'teacher'], ['id' => 'user', 'text' => 'user']]
                ],
                [
                    'name' => 'is_admin',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'inactive'], ['id' => 1, 'text' => 'active']]
                ],
                [
                    'name' => 'status',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'inactive'], ['id' => 1, 'text' => 'active']]
                ],
                [
                    'name' => 'verified',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'inactive'], ['id' => 1, 'text' => 'active']]
                ],
                [
                    'name' => 'access_level',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'not_access'], ['id' => 1, 'text' => 'limited_access'], ['id' => 2, 'text' => 'normal_access'], ['id' => 3, 'text' => 'full_access']]
                ],
                [
                    'name' => 'created_at',
                    'type' => 'date',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => false
                ],
                [
                    'name' => 'updated_at',
                    'type' => 'date',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => false
                ],
                [
                    'name' => 'role_id',
                    'type' => 'select',
                    'input_type' => 'multiple',
                    'is_related_field'=>true,
                    'orderable' => false,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'department_id',
                    'type' => 'select',
                    'input_type' => 'multiple',
                    'is_related_field'=>true,
                    'orderable' => false,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],

            ]
        ];
    }

    public static function  relatedFields(){
        return [
            [
                'name' => 'profile',
                'table'=>Profile::getTableName(),
                'items' => Profile::getSubFields(),
                'show_in_form' => true,
                'show_in_table' => true,

            ],
            [
                'name' => 'roles',
                'table'=>Role::getTableName(),
                'items' => Role::getSubFields(),
                'show_in_form' => false,
                'show_in_table' => false,

            ],
            [
                'name' => 'departments',
                'table'=>Department::getTableName(),
                'items' => Department::getSubFields(),
                'show_in_form' => false,
                'show_in_table' => false,

            ],
        ];
    }
    
    protected static $logAttributes = ['username', 'name', 'email', 'gender', 'is_admin', 'status', 'verified', 'verify_email_link', 'access_level', 'remember_token'];
    protected static $logName = 'مدیریت کاربران';
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = $this->getEventName($eventName);
        return "کاربر مورد نظر {$eventName}";
    }

    protected function getEventName(string $eventName)
    {
        switch ($eventName) {
            case 'created':
                $eventName = 'ایجاد شد';
                break;
            case 'updated':
                $eventName = 'بروزرسانی شد';
                break;
            case 'deleted':
                $eventName = 'حذف شد';
                break;
        }
        return $eventName;
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department', 'department_user', 'user_id', 'department_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'id');
    }

}
