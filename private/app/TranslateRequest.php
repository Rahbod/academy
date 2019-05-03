<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class TranslateRequest extends Model
{
    use ModelTrait;

    protected $fillable = ['author_id','category_id','title','translation_language','description','status'];

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
                    'name' => 'author_id',
                    'type' => 'numeric',
                    'input_type' => 'disable',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'category_id',
                    'type' => 'numeric',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'title',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'translation_language',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'description',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'status',
                    'type' => 'string',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options'=>[
                        ['id'=>'INIT','text'=>'INIT'],
                        ['id'=>'REJECTED','text'=>'REJECTED'],
                        ['id'=>'TRANSLATED','text'=>'TRANSLATED'],
                    ]
                ],
            ]
        ];
    }



    public static function  relatedFields(){
        return  [
            [
                'name' => 'author',
                'table' => User::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => User::getSubFields()
            ],
            [
                'name' => 'category',
                'table' => Category::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => Category::getSubFields()
            ],
            [
                'name' => 'attachments',
                'table' => Attachment::getTableName(),
                'show_in_form' => true,
                'show_in_table' => false,
                'items' => Attachment::getSubFields()
            ]
        ];
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function attachments()
    {
        return $this->morphMany('App\Attachment', 'attachmentable');
    }
}
