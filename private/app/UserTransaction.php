<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use ModelTrait;

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
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'transaction_id',
                    'type' => 'numeric',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'paymentable_type',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => false,
                    'show_in_sub_form' => false,
                    'options'=>[
                        [ 'id'=>'App\\TranslateRequest', 'text'=>'TranslateRequest'],
                        [ 'id'=>'App\\UserClass', 'text'=>'UserClass'],

                    ]
                ],
                [
                    'name' => 'paymentable_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'show_in_sub_form' => false,
                ],
                [
                    'name' => 'type',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options'=>[
                        ['id'=>'CRASH','text'=>'CRASH'],
                        ['id'=>'GATEWAY','text'=>'GATEWAY'],
                    ]
                ],
                [
                    'name' => 'price',
                    'type' => 'numeric',
                    'input_type' => 'number',
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
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'status',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 'INIT', 'text' => 'INIT'],['id' => 'SUCCEED', 'text' => 'SUCCEED'], ['id' => 'FAILED', 'text' => 'FAILED']]
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
                'name' => 'user',
                'table' => User::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => User::getSubFields()
            ],
            [
                'name' => 'transaction',
                'table' => GatewayTransaction::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => GatewayTransaction::getSubFields()
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function transaction()
    {
        return $this->belongsTo('App\GatewayTransaction');
    }

    /**
     * Get all of the owning commentable models.
     */
    public function paymentable()
    {
        return $this->morphTo();
    }
}
