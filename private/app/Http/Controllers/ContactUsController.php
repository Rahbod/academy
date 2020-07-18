<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';


        $breadcrumbs[1]['title'] = __('messages.global.contact-us');
        $breadcrumbs[1]['link'] = 'contact-us';

        return view('main_template.pages.contact-us')->with('breadcrumbs', $breadcrumbs);
    }

    public function store(Request $request)
    {
        //sent info to management

        $this->validate($request, [
            'relevant_section' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ]);

        $feedback = new Feedback();
        $feedback->relevant_section = $request->relevant_section;
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->content = $request->input('content');
//        $feedback->archive = 0;
        $status = $feedback->save();

//        return view('main_template.pages.message')->with([
//            'type' => 'success',
//            'title' => trans('notifications.stored_successfully'),
//            'message' => trans('notifications.stored_successfully_content')
//        ]);

        return response()->json(['message' => 'information stored successfully'], 200);
    }

    public function storeNewsLetter(Request $request)
    {
        //save user request for recieving site newsletter

        return response()->json(['title' => 'success', 'message' => 'information stored successfully']);
    }


    public function aboutUs()
    {
        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';


        $breadcrumbs[1]['title'] = __('messages.global.about-us');
        $breadcrumbs[1]['link'] = 'about-us';

        return view('main_template.pages.about-us')->with('breadcrumbs', $breadcrumbs);
    }

    public function test()
    {
        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';


        $breadcrumbs[1]['title'] = __('pages.breadcrumb-title');
        $breadcrumbs[1]['link'] = 'test';

        return view('main_template.pages.static_pages.test')->with('breadcrumbs', $breadcrumbs);
    }
}
