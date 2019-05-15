<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Appnegar\Cms\Traits\SetAndGetDateAttributesTrait;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use ModelTrait;
    use SetAndGetDateAttributesTrait;

    protected $fillable = [
        'user_id','title','source','attachmentable_id ','attachmentable_type ',
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
                    'name' => 'user_id',
                    'type' => 'numeric',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
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
                    'name' => 'source',
                    'type' => 'string',
                    'input_type' => 'file',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'attachmentable_type',
                    'type' => 'string',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false,
                    'options'=>[
                        [ 'id'=>'App\\TranslateRequest', 'text'=>'TranslateRequest',],
                        [ 'id'=>'App\\Content', 'text'=>'Content',]

                    ]
                ],
                [
                    'name' => 'attachmentable_id',
                    'type' => 'numeric',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false,
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
        ];
    }


    public function getSourceAttribute($photo)
    {
        $resource_name = str_singular($this->getTable());
        if ($photo) {
            $path = '/storage/' . config('system.' . $resource_name . '.attachment_destination') . $photo;
            return $path;
        }

    }


    public function author()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
