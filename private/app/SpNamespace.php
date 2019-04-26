<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Appnegar\Cms\Traits\ModelTrait;

class SpNamespace extends Model
{
    use ModelTrait;

    public $timestamps=false;

    protected $table='sp_namespaces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name'
    ];

    public static function mainFields(){
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
                [
                    'name' => 'name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'display_name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
            ]
        ];
    }

    public static function  relatedFields(){
        return [
            [
                'name' => 'departments',
                'table'=>Department::getTableName(),
                'show_in_form' => true,
                'show_in_table' => false,
                'items' => Department::getSubFields()
            ]
        ];
    }

    public function departments()
    {
        return $this->hasMany('App\Department','namespace_id');
    }
}
