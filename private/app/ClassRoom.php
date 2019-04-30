<?php

namespace App;

use Appnegar\Cms\Traits\GetImageAttributesTrait;
use Appnegar\Cms\Traits\ModelTrait;
use Appnegar\Cms\Traits\SetAndGetDateAttributesTrait;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use ModelTrait;
    use SetAndGetDateAttributesTrait;

    protected $fillable = ['author_id', 'teacher_id','course_id', 'title_fa','title_en', 'description_fa', 'description_en','image', 'capacity', 'price', 'registration_start_date', 'registration_end_date','course_start_date','course_end_date', 'status'];

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
                [
                    'name' => 'author_id',
                    'type' => 'numeric',
                    'input_type' => 'disable',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'teacher_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
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
                    'name' => 'image',
                    'type' => 'string',
                    'input_type' => 'image',
                    'orderable' => false,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true
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
                    'name' => 'capacity',
                    'type' => 'numeric',
                    'input_type' => 'number',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'price',
                    'type' => 'numeric',
                    'input_type' => 'number',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
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
                    'name' => 'registration_start_date',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'registration_end_date',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'course_start_date',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'course_end_date',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
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
                'name' => 'teacher',
                'table' => User::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => User::getSubFields()
            ],
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
            ]
        ];
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\User', 'teacher_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo('App\Course', 'category_id');
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
