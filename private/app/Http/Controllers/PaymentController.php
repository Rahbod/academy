<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
//        return $request->all();

        $this->validate($request, [
            'class_id' => 'required,exists:class_rooms,id',
            'gateway_id' => 'required',
        ]);

    }
}
