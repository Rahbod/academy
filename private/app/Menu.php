<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use ModelTrait;
    public $timestamps = false;

    protected $fillable = ['name', 'display_name', 'description'];

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
                    'name' => 'icon_type',
                    'type' => 'select',
                    'input_type' => 'select',
                    'options' => [['id' => 'icm_icon', 'text' => 'icomoon'], ['id' => 'glyph_icon', 'text' => 'glyph_icon'], ['id' => 'fa_icon', 'text' => 'font_awesome']],
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
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
        $related_fields = [
            [
                'name' => 'menu_items',
                'table' => MenuItem::getTableName(),
                'show_in_form' => true,
                'show_in_table' => false,
                'items' => MenuItem::getSubFields()
            ]
        ];

        return array_merge([static::mainFields()], $related_fields);
    }


    public function menu_items()
    {
        return $this->hasMany('App\MenuItem');
    }
}
