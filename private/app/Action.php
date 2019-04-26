<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use ModelTrait;

    public $timestamps=false;

    protected $fillable = [
        'resource_id','name', 'display_name','type','need_allow', 'status', 'description'
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
                    'name' => 'resource_id',
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
                    'name' => 'resource_name',
                    'type' => 'string',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => false
                ],
                [
                    'name' => 'type',
                    'type' => 'select',
                    'input_type' => 'select',
                    'options'=>[
                        ['id'=>'general','text'=>'general'],
                        ['id'=>'page_loader','text'=>'page_loader'],
                        ['id'=>'frame_loader','text'=>'frame_loader']
                    ],
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'need_allow',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'options'=>[
                        ['id'=>0,'text'=>'inactive'],
                        ['id'=>1,'text'=>'active'],
                    ],
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'status',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'options'=>[
                        ['id'=>0,'text'=>'inactive'],
                        ['id'=>1,'text'=>'active'],
                    ],
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

    public static function relatedFields(){
        return [
            [
                'name' => 'resource',
                'table'=>Resource::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => Resource::getSubFields()
            ],
            [
                'name' => 'paths',
                'table'=>Path::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => Path::getSubFields()
            ],
        ];
    }

    public static function getFields()
    {
        return array_merge([static ::mainFields()],static::relatedFields());
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    public function paths()
    {
        return $this->hasMany('App\Path');
    }
    public function frames()
    {
        return $this->belongsToMany('App\Frame');
    }

    public function pages()
    {
        return $this->hasMany('App\Page');
    }
    public function modules()
    {
        return $this->hasMany('App\Module');
    }
}
