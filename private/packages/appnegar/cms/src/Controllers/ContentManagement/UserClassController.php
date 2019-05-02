<?php

namespace Appnegar\Cms\Controllers\ContentManagement;

use App\ClassRoom;
use App\GatewayTransaction;
use App\User;
use Appnegar\Cms\Controllers\AdminController;
use Illuminate\Validation\Rule;

class UserClassController extends AdminController
{

    public function __construct()
    {
        $this->resource = 'UserClass';
    }


    protected function setRequest($request, $model)
    {
        if (!$request['lang']) {
            $request['lang'] = session('lang');
        }
        $transaction = $request['transaction'];
        $transaction['user_id'] = $request['user_id'];
        if ($request['id'] !== 0) {
            $transaction['user_class_id'] = $model['id'];
        }
        $request['transaction'] = $transaction;
        return $request;
    }

    protected function validationRules($request, $id = null)
    {
        $rules = [
            'user_id' => [
                'required',
                Rule::unique('user_classes')->where(function ($query) use ($request,$id) {
                    return $query->where('class_room_id', $request->class_room_id)->where('id', '<>', $id);
                })
            ],
            'class_room_id' => 'nullable|exists:class_rooms,id',
            'status' => 'nullable|numeric|min:0|max:1',
            'transaction.transaction_id' => 'nullable|numeric|unique:gateway_transactions,id',
            'transaction.type' => 'required|in:CRASH,GATEWAY',
            'transaction.price' => 'required|numeric|min:0',
            'transaction.status' => 'required|in:INIT,SUCCEED,FAILED',
        ];
        if ($id) {
            $rules['transaction.transaction_id'] .= ',' . $id;
        }
        return $rules;
    }

    protected function getFormData($data)
    {
        return [
            'model' => $data,
            'options' => [
                'user_id' => User::where('status', 1)->select(['id', 'name AS text'])->get(),
                'class_room_id' => ClassRoom::select(['id', 'title_fa AS text'])->get(),
                'transaction_id' => GatewayTransaction::select(['id'])->get()->pluck('id')
            ]
        ];
    }
}