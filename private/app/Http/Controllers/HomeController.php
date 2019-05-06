<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\SliderGroup;
use Carbon\Carbon;

class HomeController extends Controller
{
    public $lang;

    public function __construct()
    {
//        $this->lang = session('lang');
        $this->lang = 'en';
    }

    public function index()
    {
        $sliders = SliderGroup::with('sliders')->where('special_name', 'main_slider')->limit(5)->get();

        $courses = Course::with('tags')->whereStatus(1)->whereLang($this->lang)->where(function ($q) {
            $q->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
        })->orderBy('order')->limit(9)->get();

        $news = Category::whereHas('contents', function ($q) {
            $q->where('type', 'news')->whereStatus(1)->whereLang($this->lang);
        })->with('contents')->where('type', 'news')->whereStatus(1)->whereLang($this->lang)->get();

        return view('main_template.pages.home');
    }
}
