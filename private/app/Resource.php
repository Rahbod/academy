<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use ModelTrait;

    public $timestamps=false;

    protected $fillable = [
        'resource_group_id','parent_id','name', 'display_name', 'description'
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
                    'is_table_field' => false,
                    'orderable' => false,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false
                ],
                [
                    'name' => 'resource_group_id',
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
                    'name' => 'parent_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
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
                    'name' => 'display_name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
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

    public static function  relatedFields(){
        return [
            [
                'name' => 'resource_group',
                'table'=>ResourceGroup::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => ResourceGroup::getSubFields()
            ],
            [
                'name' => 'actions',
                'table'=>Action::getTableName(),
                'show_in_form' => true,
                'show_in_table' => false,
                'items' => Action::getSubFields()
            ],
        ];
    }

    public function actions()
    {
        return $this->hasMany('App\Action');
    }
    public function paths()
    {
        return $this->hasManyThrough('App\Path', 'App\Action');
    }

    public function parent()
    {
        return $this->belongsTo('App\Resource','parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Resource','parent_id');
    }

    public function resource_group()
    {
        return $this->belongsTo('App\ResourceGroup');
    }
}
