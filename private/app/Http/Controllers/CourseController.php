<?php

namespace App\Http\Controllers;

use App\Category;
use App\ClassRoom;
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

    public function termShow($course_id)
    {
        $course = $this->query
            ->with(['terms.class_rooms' => function ($q) {
            $q->where('registration_start_date', '<=', Carbon::now())->where('registration_end_date', '>=', Carbon::now());}])
            ->with(['terms' => function ($q) {$q->withCount('class_rooms');}])->findOrFail($course_id);

//        dd($course);

        return view('main_template.pages.courses.course-registration')->with('course', $course);
    }

    public function classShow($id)
    {
//        $term = Term::with('class_rooms.teacher')->findOrFail($id);
        $term = Term::with(['class_rooms' => function ($q) {
            $q->with('class_room_times')->with('teacher');
        }])->with('course')->findOrFail($id);
//        dd($term);
        $class_view = view('main_template.pages.courses.step-2')
            ->with('course', $term['course'])
            ->with('term', $term)
            ->with('class_rooms', $term['class_rooms']);
        return $class_view;
    }

    public function verify($class_id)
    {
        $class_room = ClassRoom::with('teacher')->with('term.course')->with('class_room_times')->findOrFail($class_id);
//        dd($class_room);

        $class_view = view('main_template.pages.courses.verify')
            ->with('class_room', $class_room)
            ->with('term', $class_room['term'])
            ->with('course', $class_room['course']);
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
