<?php
namespace Appnegar\Cms\Controllers\Admin;


use Appnegar\Cms\Controllers\AdminController;

class TagController extends AdminController{

    public function __construct(){
        $this->resource='Tag';
    }

    protected function validationRules($request, $id = null)
    {
        return[
            'name'=>'required',
        ];
    }

}