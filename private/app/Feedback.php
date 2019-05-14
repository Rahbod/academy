<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use ModelTrait;

    public $timestamps = false;

    protected $fillable = ['name','relevant_section','email','content'];

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
                    'show_in_form' => true
                ],
                [
                    'name' => 'relevant_section',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
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
                    'name' => 'email',
                    'type' => 'string',
                    'input_type' => 'email',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'content',
                    'type' => 'string',
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],

                [
                    'name' => 'archive',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'inactive'], ['id' => 1, 'text' => 'active']]
                ],
            ]
        ];
    }
}
