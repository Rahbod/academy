<?php
namespace Appnegar\Cms\Controllers\ContentManagement;

use App\ClassRoom;
use App\GatewayTransaction;
use App\User;
use Appnegar\Cms\Controllers\AdminController;

class UserClassController extends AdminController{

    public function __construct(){
        $this->resource='UserClass';
    }

    protected function validationRules($request, $id = null)
    {
        $rules=[
            'transaction_id'=>'nullable|exists:gateway_transactions,id',
            'user_id'=>'nullable|exists:users,id',
            'class_room_id'=>'nullable|exists:class_rooms,id',
            'status'=>'nullable|numeric|min:0|max:1'
        ];
        return $rules;
    }

    protected function getFormData($data)
    {
        return[
            'model'=>$data,
            'options'=>[
                'user_id'=>User::where('status',1)->select(['id','name AS text'])->get(),
                'transaction_id'=>GatewayTransaction::select('id')->get(),
                'class_room_id'=>ClassRoom::select(['id','title_fa AS text'])->get()
            ]
        ];
    }
}