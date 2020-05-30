<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Appnegar\Cms\Traits\SetAndGetDateAttributesTrait;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use ModelTrait;
    use SetAndGetDateAttributesTrait;

    protected $fillable = ['author_id', 'course_id', 'title_fa','title_en', 'description_fa', 'description_en', 'status'];

    public static function mainFields(){
        return [
            'name' => static ::getTableName(),
            'items' => [
                [
                    'name' => 'lang',
                    'type' => 'select',
                    'input_type' => 'select',
                    'options' => [['id' => 'fa', 'text' => 'fa'], ['id' => 'en', 'text' => 'en']],
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
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
//                [
//                    'name' => 'author_id',
//                    'type' => 'numeric',
//                    'input_type' => 'hidden',
//                    'orderable' => true,
//                    'searchable' => true,
//                    'show_in_table' => false,
//                    'show_in_form' => true,
//                ],
                [
                    'name' => 'course_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'title_fa',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'title_en',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'description_fa',
                    'type' => 'string',
                    'input_type' => 'editor',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'description_en',
                    'type' => 'string',
                    'input_type' => 'editor',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'order',
                    'type' => 'numeric',
                    'input_type' => 'number',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'status',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'inactive'], ['id' => 1, 'text' => 'active']]
                ],
                [
                    'name' => 'created_at',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => false,
                ],
                [
                    'name' => 'updated_at',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => false,
                ],
            ]
        ];
    }

    public static function  relatedFields(){
        return [
            [
                'name' => 'author',
                'table' => User::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => User::getSubFields()
            ],
            [
                'name' => 'course',
                'table' => Course::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => Course::getSubFields()
            ],
            [
                'name' => 'class_rooms',
                'table' => ClassRoom::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => ClassRoom::getSubFields()
            ],
        ];
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }

    public function class_rooms()
    {
        return $this->hasMany('App\ClassRoom');
    }
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
