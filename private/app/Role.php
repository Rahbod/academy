<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Appnegar\Cms\Traits\RoleTrait;
use Spatie\Activitylog\Traits\LogsActivity;

use Appnegar\Cms\Traits\ModelTrait;

class Role extends Model
{
    use RoleTrait;
    use ModelTrait;
    use LogsActivity;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public static function mainFields(){
        return  [
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
                    'show_in_form' => true,
                    'show_in_sub_form' => true,
                ],
                [
                    'name' => 'action_id',
                    'type' => 'numeric',
                    'input_type' => 'hidden',
                    'is_related_field' => true,
                    'orderable' => false,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false,
                ],
                [
                    'name' => 'name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => true,
                ],
                [
                    'name' => 'display_name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => true,
                    'show_in_form' => true,
                    'show_in_sub_form' => true,
                ],
                [
                    'name' => 'description',
                    'type' => 'string',
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => true,
                ],
            ]
        ];
    }

    public static function getFields()
    {
        $related_fields= [
            [
                'name' => 'actions',
                'table'=>Action::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => Action::getSubFields()
            ],
            [
                'name' => 'users',
                'table'=>User::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => User::getSubFields()
            ],
        ];
        return array_merge([static ::mainFields()],$related_fields);
    }

    protected static $logAttributes = ['id', 'name', 'display_name', 'description'];
    protected static $logName = 'مدیریت نقش ها';
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = $this->getEventName($eventName);
        return "نقش مورد نظر {$eventName}";
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

}
