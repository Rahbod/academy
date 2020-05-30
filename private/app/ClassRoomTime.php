<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Appnegar\Cms\Traits\SetAndGetDateAttributesTrait;
use Illuminate\Database\Eloquent\Model;

class ClassRoomTime extends Model
{
    use ModelTrait;
    use SetAndGetDateAttributesTrait;

    protected $fillable = ['author_id','class_room_id', 'start_time','end_time', 'week_day'];

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
                    'name' => 'class_room_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'show_in_sub_form' => false,
                ],
                [
                    'name' => 'start_time',
                    'type' => 'string',
                    'input_type' => 'time',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'end_time',
                    'type' => 'string',
                    'input_type' => 'time',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'week_day',
                    'type' => 'string',
                    'input_type' => 'select',
                    'orderable' => false,
                    'searchable' => false,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options'=>[
                        'saturday','sunday','monday','tuesday','wednesday','thursday','friday'
                    ]
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

}
