<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserClass extends Model
{
    use ModelTrait;

    protected $fillable = ['user_id','class_room_id','status'];

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
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => User::getSubFields()
            ],
            [
                'name' => 'classroom',
                'table' => ClassRoom::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => ClassRoom::getSubFields()
            ],
            [
                'name' => 'transaction',
                'table' => UserTransaction::getTableName(),
                'show_in_form' => true,
                'show_in_table' => false,
                'items' => UserTransaction::getSubFields()
            ],
        ];
    }

    public function transaction()
    {
        return $this->morphOne('App\UserTransaction','paymentable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function classroom()
    {
        return $this->belongsTo('App\ClassRoom');
    }
}
