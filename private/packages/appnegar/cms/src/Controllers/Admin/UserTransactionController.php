<?php
namespace Appnegar\Cms\Controllers\Admin;


use Appnegar\Cms\Controllers\AdminController;

class UserTransactionController extends AdminController{

    public function __construct(){
        $this->resource='UserTransaction';
    }

    protected function validationRules($request, $id = null)
    {
        return[
            'user_id'=>'nullable',
            'transaction_id'=>'nullable',
            'paymentable_type'=>'required',
            'paymentable_id'=>'required',
            'type'=>'required|in:CRASH,GATEWAY',
            'price'=>'required|numeric|min:0',
            'description'=>'nullable',
            'status'=>'required|in:INIT,SUCCEED,FAILED',
        ];
    }

}