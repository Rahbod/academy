<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Term;
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

    public function termShow($id)
    {
        $course = $this->query->with('terms')->where('id', $id)->first();
        return view('main_template.pages.courses.course-registration')->with('course', $course);
    }

    public function classShow($id)
    {
        $term = Term::with('class_rooms.teacher')->findOrFail($id);
        $class_view = view('main_template.pages.courses.step-2')->with('class_rooms', $term->class_rooms);
        return $class_view;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $course = Course::with(['tags', 'category'])->with('comments')->findOrFail($id);
        $related_courses = Category::where('lang', $this->lang)->where(function ($q2) {
            $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
        })->with(['courses' => function ($c) {
            $c->where('lang', $this->lang)->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            })->take(4);
        }])->where('id', $course->category->id)->first();

        return view('main_template.pages.courses.show')
            ->with('course', $course)
            ->with('related_courses', $related_courses['courses']);
    }
}
