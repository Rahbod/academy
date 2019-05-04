<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use ModelTrait;

    public $timestamps = false;

    protected $fillable = ['name'];

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
                    'name' => 'name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
            ]
        ];
    }

    public function contents()
    {
        return $this->morphedByMany('App\Content', 'taggable');
    }

    public function course()
    {
        return $this->morphedByMany('App\Course', 'taggable');
    }
}
