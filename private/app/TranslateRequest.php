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
                    'input_type' => 'hidden',
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
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'translated_file',
                    'type' => 'string',
                    'input_type' => 'file',
                    'orderable' => false,
                    'searchable' => false,
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
                        ['id'=>'PENDING','text'=>'PENDING'],
                        ['id'=>'REJECTED','text'=>'REJECTED'],
                        ['id'=>'AWAITING_PAYMENT','text'=>'AWAITING_PAYMENT'],
                        ['id'=>'PAID','text'=>'PAID'],
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


    public function getTranslatedFileAttribute($photo)
    {
        $resource_name = str_singular($this->getTable());
//        dd('system.' . $resource_name . '.translated_file');
        if ($photo) {
            $path = '/storage/' . config('system.' . $resource_name . '.translated_file_destination') . $photo;
            return $path;
        }

    }
}
