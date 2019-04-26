<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use ModelTrait;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','display_name','value', 'details','type','direction','order'
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
                    'show_in_form' => true
                ],
                [
                    'name' => 'setting_group_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false
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
                ],
                [
                    'name' => 'display_name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'value',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'details',
                    'type' => 'string',
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'type',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options'=>[
                        ['id'=>'select'],
                        ['id'=>'radio'],
                        ['id'=>'textarea'],
                        ['id'=>'text'],
                        ['id'=>'editor'],
                        ['id'=>'tags'],
                        ['id'=>'email'],
                        ['id'=>'number'],
                    ]
                ],
                [
                    'name' => 'direction',
                    'type' => 'select',
                    'input_type' => 'select',
                    'table_style'=>'{"display":"none"}',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options'=>[
                        ['id'=>'inherit','text'=>'default'],
                        ['id'=>'ltr','text'=>'left_to_right'],
                        ['id'=>'rtl','text'=>'right_to_left']
                    ]
                ],
                [
                    'name' => 'order',
                    'type' => 'numeric',
                    'input_type' => 'number',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
            ]
        ];
    }

    public static function  relatedFields(){
        return [
            [
                'name' => 'setting_group',
                'table'=>SettingGroup::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => SettingGroup::getSubFields()
            ]
        ];
    }

    public function setting_group()
    {
        return $this->belongsTo('App\SettingGroup');
    }
}
