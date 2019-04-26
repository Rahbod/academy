<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kalnoy\Nestedset\NodeTrait;

class MenuItem extends Model
{
    use NodeTrait;
    use ModelTrait;

    public $timestamps = false;
//    protected $with = ['children'];

    protected $fillable = ['path_id', 'parent_id', 'menu_id', 'name', 'display_name', 'url', 'icon', 'target', 'order', 'description'];

    protected static function boot()
    {
        parent::boot();

        // Order by order ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    protected function getScopeAttributes()
    {
        return ['menu_id'];
    }

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
                    'name' => 'path_id',
                    'type' => 'numeric',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'parent_id',
                    'type' => 'numeric',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'menu_id',
                    'type' => 'numeric',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
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
                [
                    'name' => 'url',
                    'type' => 'string',
                    'input_type' => 'text',
                    'direction'=>'ltr',
                    'table_style'=>'{"text-align":"center"}',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'icon',
                    'type' => 'string',
                    'input_type' => 'icon_picker',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'target',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'order',
                    'type' => 'numeric',
                    'input_type' => 'number',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'description',
                    'type' => 'string',
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
            ]
        ];
    }


    public static function getFields()
    {
        $related_fields= [
            [
                'name' => 'menu',
                'table'=>Menu::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => Menu::getSubFields()
            ],
        ];

        return array_merge([static ::mainFields()],$related_fields);
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

    public function path()
    {
        return $this->belongsTo('App\Path');
    }

    public function children()
    {
        return $this->hasMany('App\MenuItem', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\MenuItem', 'id', 'parent_id');
    }
}
