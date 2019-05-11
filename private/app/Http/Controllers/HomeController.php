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
        $main_sliders = SliderGroup::with('sliders')->where('special_name', 'main_slider')->limit(5)->first();

        $courses = Course::with('tags')->whereStatus(1)->whereLang($this->lang)->where(function ($q) {
            $q->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
        })->orderBy('order')->limit(9)->get();

        $news_category = Category::whereHas('contents', function ($q) {
            $q->where('type', 'news')->whereStatus(1)->whereLang($this->lang)->take(8);
        })->with('contents')->where('type', 'news')->whereStatus(1)->whereLang($this->lang)->first();

        $article_category = Category::whereHas('contents', function ($q) {
            $q->where('type', 'article')->whereStatus(1)->whereLang($this->lang)->take(8);
        })->with('contents')->where('type', 'article')->whereStatus(1)->whereLang($this->lang)->take(5)->first();

        return view('main_template.pages.home')
            ->with('main_sliders', $main_sliders)
            ->with('courses', $courses)
            ->with('news', $news_category['contents'])
            ->with('articles', $article_category['contents']);
    }
}
