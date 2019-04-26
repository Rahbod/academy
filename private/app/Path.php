<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    use ModelTrait;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id','action_id', 'name', 'display_name', 'slug', 'method', 'order', 'middleware', 'description'
    ];

    public static function mainFields(){
        return [
            'name' => static ::getTableName(),
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
                ],
                [
                    'name' => 'department_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => false,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false
                ],
                [
                    'name' => 'action_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false,
                ],
                [
                    'name' => 'name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'direction'=>'ltr',
                    'table_style'=>'{"text-align":"center"}',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'display_name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'slug',
                    'type' => 'string',
                    'input_type' => 'text',
                    'direction'=>'ltr',
                    'input_style'=>'{}',
                    'table_style'=>'{"text-align":"center"}',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'method',
                    'type' => 'select',
                    'input_type' => 'select',
                    'options'=>[
                        ['id'=>'get'],
                        ['id'=>'post'],
                        ['id'=>'put'],
                        ['id'=>'delete']
                    ],
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'order',
                    'type' => 'numeric',
                    'input_type' => 'number',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'middleware',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
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

    public static function  relatedFields(){
        return [
            [
                'name' => 'department',
                'table'=>Department::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => Department::getSubFields()
            ],
            [
                'name' => 'action',
                'table'=>Action::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => Action::getSubFields()
            ],
        ];
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function action()
    {
        return $this->belongsTo('App\Action');
    }
}
