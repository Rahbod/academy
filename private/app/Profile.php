<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Appnegar\Cms\Traits\SetAndGetDateAttributesTrait;
use Appnegar\Cms\Traits\GetImageAttributesTrait;

use Appnegar\Cms\Traits\ModelTrait;



class Profile extends Model
{
    use SetAndGetDateAttributesTrait;
    use GetImageAttributesTrait;
    use ModelTrait;

    public $timestamps = false;



    protected $fillable = [
        'user_id', 'mobile_number','melli_code', 'gender','grade', 'birthday', 'city','address', 'postal_code', 'description'
    ];

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
                    'show_in_form' => true,
                    'show_in_sub_form' => true,
                ],
                [
                    'name' => 'mobile_number',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'melli_code',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'gender',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => true,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'male'], ['id' => 1, 'text' => 'female']]
                ],
                [
                    'name' => 'grade',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'birthday',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'address',
                    'type' => 'string',
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'city',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'postal_code',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'description',
                    'type' => 'string',
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
            ]
        ];
    }

    protected static $logAttributes = [ 'user_id', 'full_name', 'avatar', 'banner', 'mobile_number', 'card_number', 'birthday', 'website', 'address', 'postal_code', 'social_networks', 'description'];
    protected static $logName = 'مدیریت پروفایل کاربران';
    protected static $logOnlyDirty = true;
    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName=$this->getEventName($eventName);
        return "پروفایل مورد نظر {$eventName}";
    }
    protected function getEventName(string $eventName){
        switch ($eventName){
            case 'created':
                $eventName='ایجاد شد';
                break;
            case 'updated':
                $eventName='بروزرسانی شد';
                break;
            case 'deleted':
                $eventName='حذف شد';
                break;
        }
        return $eventName;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
