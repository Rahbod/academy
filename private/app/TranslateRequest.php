<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class TranslateRequest extends Model
{
    use ModelTrait;

    const TYPE_TRANSLATE = 'translate';
    const TYPE_EDITING = 'editing';
    const TYPE_CONSULTATION = 'consultation';

    protected $fillable = [
            'author_id',
            'category_id',
            'title',
            'source_language',
            'translation_language',
            'price',
            'description',
            'translated_file',
            'status',
            'type'
    ];

    public static $types = [
            self::TYPE_TRANSLATE => 'translate',
            self::TYPE_EDITING => 'editing',
            self::TYPE_CONSULTATION => 'consultation'
    ];

    public static function mainFields()
    {
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
//                [
//                    'name' => 'author_id',
//                    'type' => 'numeric',
//                    'input_type' => 'hidden',
//                    'orderable' => true,
//                    'searchable' => true,
//                    'show_in_table' => false,
//                    'show_in_form' => true
//                ],
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
                                'name' => 'source_language',
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
                                'name' => 'price',
                                'type' => 'numeric',
                                'input_type' => 'number',
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
                                'options' => [
                                        ['id' => 'PENDING', 'text' => 'PENDING'],
                                        ['id' => 'REJECTED', 'text' => 'REJECTED'],
                                        ['id' => 'AWAITING_PAYMENT', 'text' => 'AWAITING_PAYMENT'],
                                        ['id' => 'PAID', 'text' => 'PAID'],
                                        ['id' => 'TRANSLATED', 'text' => 'TRANSLATED'],
                                ]
                        ],
                        [
                                'name' => 'type',
                                'type' => 'string',
                                'input_type' => 'hidden',
                                'orderable' => true,
                                'searchable' => true,
                                'show_in_table' => true,
                                'show_in_form' => true,
                        ],
                ]
        ];
    }


    public static function relatedFields()
    {
        return [
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
                ],
                [
                        'name' => 'transaction',
                        'table' => UserTransaction::getTableName(),
                        'show_in_form' => false,
                        'show_in_table' => false,
                        'items' => UserTransaction::getSubFields()
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

    public function transaction()
    {
        return $this->morphOne('App\UserTransaction', 'paymentable');
    }


    public function getTranslatedFileAttribute($photo)
    {
        $resource_name = str_singular($this->getTable());
        if ($photo) {
            $path = '/storage/' . config('system.' . $resource_name . '.translated_file_destination') . $photo;
            return $path;
        }

    }
}
