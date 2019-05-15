<?php

namespace App\Http\Controllers;

use App\Feedback;
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

        $this->validate($request,[
            'relevant_section'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'content'=>'required',
        ]);

        $feedback=new Feedback();
        $feedback->relevant_section=$request->relevant_section;
        $feedback->name=$request->name;
        $feedback->email=$request->email;
        $feedback->content=$request->input('content');
        $feedback->archive=0;
        $status=$feedback->save();

        return response()->json(['message'=>'information stored successfully'],200);
    }
    public function storeNewsLetter(Request $request)
    {
        //save user request for recieving site newsletter

        return response()->json(['title'=>'success','message'=>'information stored successfully']);
    }
}
