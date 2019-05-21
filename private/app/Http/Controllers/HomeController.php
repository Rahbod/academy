<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\SliderGroup;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $main_sliders = SliderGroup::with(['sliders'=> function($q){
            $q->where('lang',session('lang'))->where('status',1);
        }])
            ->where('special_name', 'main_slider')
            ->where('status',1)
            ->where('lang',session('lang'))
            ->limit(5)->first();

        $courses = Course::with('tags')->whereStatus(1)->whereLang(session('lang'))->where(function ($q) {
            $q->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
        })->orderBy('order')->limit(9)->get();

        $news_category = Category::with(['contents' => function ($q) {
            $q->where('type', 'news')->whereStatus(1)->whereLang(session('lang'))->with('tags')->take(10);
        }])->where('type', 'news')->whereStatus(1)->whereLang(session('lang'))->first();


//        dd($news_category);
        $article_category = Category::with(['contents' => function ($q) {
            $q->where('type', 'article')->whereStatus(1)->whereLang(session('lang'))->with('tags')->orderByDesc('created_at')->take(4);
        }])->where('type', 'article')->whereStatus(1)->whereLang(session('lang'))->first();
//        dd($article_category);

        return view('main_template.pages.home')
            ->with('main_sliders', $main_sliders)
            ->with('courses', $courses)
            ->with('news', $news_category['contents'])
            ->with('articles', $article_category['contents']);
    }
}
