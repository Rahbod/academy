<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Appnegar\Cms\Traits\SetAndGetDateAttributesTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class StaticMenu extends Model
{
    use NodeTrait;
    use ModelTrait;
    use SetAndGetDateAttributesTrait;

    protected $fillable=['author_id','parent_id','name','special_name','lang','description','order','status','_lft','_rgt'];

    protected function getScopeAttributes()
    {
        return ['lang'];
    }

    public static function mainFields(){
        return [
            'name' => static ::getTableName(),
            'items' => [
                [
                    'name' => 'lang',
                    'type' => 'select',
                    'input_type' => 'select',
                    'options' => [['id' => 'fa', 'text' => 'fa'], ['id' => 'en', 'text' => 'en']],
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
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
//                    'input_type' => 'disable',
//                    'orderable' => true,
//                    'searchable' => true,
//                    'show_in_table' => false,
//                    'show_in_form' => true,
//                ],
                [
                    'name' => 'parent_id',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'special_name',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'description',
                    'type' => 'string',
                    'input_type' => 'textarea',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'order',
                    'type' => 'numeric',
                    'input_type' => 'number',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'status',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options' => [['id' => 0, 'text' => 'inactive'], ['id' => 1, 'text' => 'active']]
                ],
                [
                    'name' => 'has_content',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options' => [['id' => 1, 'text' => 'has'], ['id' => 0, 'text' => 'has_not']]
                ],
                [
                    'name'=>'type',
                    'type' => 'select',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options' => [['id' => 'action', 'text' => 'action'], ['id' => 'page', 'text' => 'page'], ['id' => 'link', 'text' => 'link']]
                ],
                [
                    'name'=>'link',
                    'type' => 'string',
                    'input_type' => 'hidden',
                    'direction'=>'ltr',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                ],
                [
                    'name'=>'page_id',
                    'type' => 'numeric',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
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
                ]
            ]
        ];
    }

    public static function  relatedFields(){
        return  [
            [
                'name' => 'author',
                'table' => User::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => User::getSubFields()
            ],
            [
                'name' => 'page',
                'table' => Page::getTableName(),
                'show_in_form' => false,
                'show_in_table' => false,
                'items' => Page::getSubFields()
            ]
        ];
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo('App\Page');
    }

}
