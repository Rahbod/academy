<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public $lang;
    protected $query;

    public function __construct()
    {
//        $this->lang = session('lang');
        $this->lang = 'en';
        $this->setQuery();
    }

    public function setQuery()
    {
        $this->query = Course::query();
        $this->query->where('status', 1)->where('lang', $this->lang)
            ->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            });
    }

    public function index()
    {
        return view('main_template.pages.courses.index')->with('courses', $this->query->paginate(9));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
//        $course = Course::with('tags')->with(['class_rooms' => function ($q) {
//            $q->with('class_room_times')->with('teacher');
//        }])->findOrFail($id);

        $course = Course::with(['tags', 'category'])->with('comments')->findOrFail($id);

//        dd($course);
        $related_courses = Category::where('lang', $this->lang)->where(function ($q2) {
            $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
        })->with(['courses' => function ($c) {
            $c->where('lang', $this->lang)->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            })->take(4);
        }])->where('id', $course->category->id)->first();

//        dd($related_courses->courses);
        return view('main_template.pages.courses.show')
            ->with('course', $course)
            ->with('related_courses', $related_courses['courses']);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
