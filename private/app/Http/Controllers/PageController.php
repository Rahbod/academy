<?php

namespace App\Http\Controllers;

use App\Category;
use App\ClassRoom;
use App\Course;
use App\Page;
use App\Term;
use App\UserClass;
use Carbon\Carbon;

class PageController extends Controller
{
    public $lang;
    protected $query;

    public function __construct()
    {
        $this->setQuery();
    }

    public function setQuery()
    {
        $this->query = Page::query();
        $this->query->where('status', 1)
            ->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            });
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function show($id)
    {
        $course = Page::findOrFail($id);

        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';

//
//        $breadcrumbs[1]['title'] = __('messages.home.course-title');
//        $breadcrumbs[1]['link'] = 'courses';
//
//        $breadcrumbs[2]['title'] = $course['title_' . session('lang')];
//        $breadcrumbs[2]['link'] = "courses/$course->id/" . $course['title_' . session('lang')];


        return view('main_template.pages.page.show')
            ->with('page', $course)
            ->with('breadcrumbs', $breadcrumbs);
    }
}
