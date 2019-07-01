<?php

namespace App\Http\Controllers;

use App\Category;
use App\ClassRoom;
use App\Course;
use App\Term;
use App\UserClass;
use Carbon\Carbon;

class CourseController extends Controller
{
    public $lang;
    protected $query;

    public function __construct()
    {
        $this->setQuery();
    }

    public function setQuery()
    {
        $this->query = Course::query();
        $this->query->where('status', 1)
            ->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            });
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function index()
    {
        $courses = $this->getQuery()->where('lang', session('lang'))->paginate(9);

        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';


        $breadcrumbs[1]['title'] = __('messages.home.course-title');
        $breadcrumbs[1]['link'] = 'courses';

        return view('main_template.pages.courses.index')->with('courses', $courses)->with('breadcrumbs', $breadcrumbs);
    }

    public function termShow($course_id)
    {
        $course = $this->query->where('lang', session('lang'))
            ->with(['terms.class_rooms' => function ($q) {
                $q->where('status', 1)->where('registration_start_date', '<=', Carbon::now())
                    ->where('registration_end_date', '>=', Carbon::now());
            }])
            ->with(['terms' => function ($q) {
                $q->where('status', 1);
            }])->findOrFail($course_id);

        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';


        $breadcrumbs[1]['title'] = __('messages.home.course-title');
        $breadcrumbs[1]['link'] = 'courses';

//        dd($course);
        if (request()->ajax()) {
            $class_view = view('main_template.pages.courses.step-1')
                ->with('course', $course);
            return $class_view;
        }

        return view('main_template.pages.courses.course-registration')
            ->with('breadcrumbs', $breadcrumbs)
            ->with('course', $course);
    }

    public function classShow($id)
    {
        $term = Term::with(['class_rooms' => function ($q) {
            $q->where('status', 1)->where('lang', session('lang'))
                ->where('registration_start_date', '<=', Carbon::now())
                ->where('registration_end_date', '>=', Carbon::now())
                ->with('class_room_times')->with(['teacher' => function ($q3) {
                    $q3->where('status', 1);
                }]);
        }])
            ->with('course')->findOrFail($id);

        $class_view = view('main_template.pages.courses.step-2')
            ->with('course', $term['course'])
            ->with('term', $term)
            ->with('class_rooms', $term['class_rooms']);
        return $class_view;
    }

    public function verify($class_id)
    {
        $user=auth()->user();

        $class_room = ClassRoom:: with('term.course')->with('class_room_times')->with(['teacher' => function ($q) {
            $q->where('status', 1);
        }])->findOrFail($class_id);

        $class_id_array = ClassRoom::where('term_id', $class_room->term->id)->get()->pluck('id');

        $user_registered_before = UserClass::where('status', 1)->where('user_id', $user->id)->whereIn('classroom_id',$class_id_array)->first();

        if ($user_registered_before) {
            return response()->json(['title' => trans('messages.global.sorry'), 'message' => trans('notifications.registered-before')], 422);
        }

        $class_view = view('main_template.pages.courses.verify')
            ->with('class_room', $class_room)
            ->with('term', $class_room['term'])
            ->with('course', $class_room['course']);
        return $class_view;
    }

    public function show($id)
    {
        $course = Course::with('tags')->with(['category' => function ($q) {
            $q->where('status', 1)->where('lang', session('lang'))->where('type', 'course');
        }])->with(['comments' => function ($q) {
            $q->where('status', 1)->where('lang', session('lang'));
        }])->findOrFail($id);

        $related_courses = Category::where('lang', session('lang'))->where(function ($q2) {
            $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
        })->with(['courses' => function ($c) {
            $c->where('lang', session('lang'))->where('status', 1)->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            })->take(4);
        }])->where('id', isset($course->category) ? $course->category->id : 3)->first();

        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';


        $breadcrumbs[1]['title'] = __('messages.home.course-title');
        $breadcrumbs[1]['link'] = 'courses';

        $breadcrumbs[2]['title'] = $course['title_' . session('lang')];
        $breadcrumbs[2]['link'] = "courses/$course->id/" . $course['title_' . session('lang')];


        return view('main_template.pages.courses.show')
            ->with('course', $course)
            ->with('related_courses', $related_courses['courses'])
            ->with('breadcrumbs', $breadcrumbs);
    }
}
