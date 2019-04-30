<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserClass extends Model
{
    use ModelTrait;

    public $timestamps = false;

    protected $fillable = ['transaction_id','user_id','class_room_id','status'];

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
                    'name' => 'transaction_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'user_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'class_room_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
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
                'name' => 'user',
                'table' => User::getTableName(),
                'show_in_form' => true,
                'show_in_table' => true,
                'items' => User::getSubFields()
            ],
            [
                'name' => 'class_room',
                'table' => ClassRoom::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => ClassRoom::getSubFields()
            ],
            [
                'name' => 'transaction',
                'table' => GatewayTransaction::getTableName(),
                'show_in_form' => true,
                'show_in_table' => false,
                'items' => GatewayTransaction::getSubFields()
            ],
        ];
    }

    protected function transaction()
    {
        return $this->belongsTo('App\GatewayTransaction','transaction_id');
    }

    protected function user()
    {
        return $this->belongsTo('App\User');
    }

    protected function class_room()
    {
        return $this->belongsTo('App\ClassRoom');
    }
}
