<?php
namespace Appnegar\Cms\Controllers\ContentManagement;


use Appnegar\Cms\Controllers\AdminController;

class TagController extends AdminController{

    public function __construct(){
        $this->resource='Tag';
    }

    protected function getTableConditions(){
        return ['lang'=>session('lang')];
    }
    protected function validationRules($request, $id = null)
    {
        return[
            'name'=>'required',
        ];
    }

}