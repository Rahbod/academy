<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('main_template.pages.contact-us');
    }

    public function store(Request $request)
    {
        //sent info to management

        return response()->json(['title'=>'success','message'=>'information stored successfully']);
    }
    public function storeNewsLetter(Request $request)
    {
        //save user request for recieving site newsletter

        return response()->json(['title'=>'success','message'=>'information stored successfully']);
    }
}
