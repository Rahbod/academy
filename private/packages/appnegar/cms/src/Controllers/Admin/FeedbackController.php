<?php
namespace Appnegar\Cms\Controllers\Admin;


use Appnegar\Cms\Controllers\AdminController;

class FeedbackController extends AdminController{

    public function __construct(){
        $this->resource='Feedback';
    }
//
//    protected function validationRules($request, $id = null)
//    {
//        return[
//            'name'=>'required',
//        ];
//    }

}