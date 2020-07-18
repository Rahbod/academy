<?php
namespace Appnegar\Cms\Controllers\Admin;


use Appnegar\Cms\Controllers\AdminController;

class FeedbackController extends AdminController{

    public function __construct(){
        $this->resource='Feedback';
    }


    protected function getTableConditions(){
        return [];
        return ['archive'=>1];
    }

    protected function validationRules($request, $id = null)
    {
        return[
            'relevant_section'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'content'=>'required',
//            'archive'=>'required',
        ];
    }

}