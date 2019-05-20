<?php

namespace App\Http\Controllers;

use App\UserClass;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
//        return $request->all();

        $this->validate($request, [
            'class_id' => 'required|exists:class_rooms,id',
            'gateway_id' => 'required',
        ]);

        if (\Auth::check()) {
            $user_class = UserClass::create([
                'user_id' => auth()->id,
                'class_room_id' => $request->class_id,
                'status' => 1,
            ]);


            //        todos
//        1-payment


            if ($user_class)
                return response()->json(['type' => 'success', 'title' => __('messages.global.success'), 'description' => __('messages.global.success-description')]);
            return response()->json(['type' => 'error', 'title' => __('messages.global.error'), 'description' => __('messages.global.error-description')]);

        }
        return response()->json(['message'=>'unauthenticated!'],401);

    }
}
