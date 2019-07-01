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
            $user = auth()->user();

            $user_class = new UserClass();
            $user_class->user_id = $user->id;
            $user_class->classroom_id = $request->class_id;
            $user_class->status = 1;
            $user_class->save();

            if ($user_class)
                return view('main_template.pages.message')
                    ->with('type', 'success')
                    ->with('title', __('messages.global.success'))
                    ->with('message', __('messages.global.success-description'));
            else
                return view('main_template.pages.message')
                    ->with('type', 'error')
                    ->with('title', __('messages.global.error'))
                    ->with('message', __('messages.global.error-description'));
        }
        return response()->json(['message' => 'unauthenticated!'], 401);

    }
}
