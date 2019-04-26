<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use ModelTrait;

    public $timestamps=false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','namespace_id', 'display_name','prefix','middleware','description'
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
                    'show_in_form' => true
                ],
                [
                    'name' => 'namespace_id',
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
                    'name' => 'prefix',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'middleware',
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
                'name' => 'sp_namespace',
                'table' => SpNamespace::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => SpNamespace::getSubFields()
            ],
            [
                'name' => 'resource_groups',
                'table' => ResourceGroup::getTableName(),
                'show_in_form' => true,
                'show_in_table' => false,
                'items' => ResourceGroup::getSubFields()
            ]
        ];
    }


    public function users()
    {
        return $this->belongsToMany('App\User','department_user','department_id','user_id');
    }

    public function resource_groups()
    {
        return $this->hasMany('App\ResourceGroup');
    }

    public function resources()
    {
        return $this->hasManyThrough('App\Resource','App\ResourceGroup');
    }

    public function sp_namespace()
    {
        return $this->belongsTo('App\SpNameSpace','namespace_id');
    }
}
