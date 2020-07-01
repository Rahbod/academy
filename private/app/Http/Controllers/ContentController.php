<?php

namespace App\Http\Controllers;

use App\Content;
use App\Course;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public $lang;
    protected $query;

    public function __construct()
    {
        $this->setQuery();
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($column_name = 'id')
    {
        $this->query = Content::query();
        $this->query->where('status', 1)
            ->orderBy($column_name)
            ->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            });
    }

    public function index()
    {
        $url_array = explode('/', request()->fullUrl());
        $content_type_name = $url_array[count($url_array) - 1];

        if (request()->query()) {
            $exploded_array = explode('?', request()->fullUrl())[0];
            $url_array = explode('/', $exploded_array);
            $content_type_name = $url_array[count($url_array) - 1];
        }

        $contents = $this->query->whereType($content_type_name)->paginate(6);

        $this->setQuery('created_at');
        $recent_contents = $this->query->whereType($content_type_name)->whereLang(session('lang'))->take(3)->get();

        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';

        $breadcrumbs[1]['title'] = __('messages.global.' . $content_type_name);
        $breadcrumbs[1]['link'] = $content_type_name;

        return view('main_template.pages.news.index')
            ->with('contents', $contents)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('content_type', $content_type_name)
            ->with('recent_posts', $recent_contents);
    }

    public function show($id)
    {
        $this->setQuery();
        $content = $this->getQuery()->where('lang', session('lang'))->with(['tags', 'author'])->findOrFail($id);
        $tags_id = $content->tags->pluck('id');
        $related_contents = Tag::with(['contents' => function ($q) use ($content) {
            $q->where('lang', session('lang'))->where('status', 1)->where(function ($q2) {
                $q2->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            })->where('id', '!=', $content->id);
        }])->whereIn('id', $tags_id)->get();

        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';

        $breadcrumbs[1]['title'] = __('messages.global.' . $content->type);
        $breadcrumbs[1]['link'] = $content->type;

        $breadcrumbs[2]['title'] = $content->title;
        $breadcrumbs[2]['link'] = "$content->type/$content->id/$content->title";

        return view('main_template.pages.news.show')
            ->with('content', $content)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('content_type', $content->type)
            ->with('related_contents', $related_contents);
    }

    public function search(Request $request)
    {
        $search_for = $request->search_query ?? $request->text;
        $search_in = $request->search_in;

        $breadcrumbs[0]['title'] = __('messages.global.home');
        $breadcrumbs[0]['link'] = 'home';

        $breadcrumbs[1]['title'] = __('messages.global.search');
        $breadcrumbs[1]['link'] = 'search';

        if ($search_for) {
            $news = null;
            $courses = null;
            $translations = null;
            $articles = null;

            switch ($search_in) {
                case 'courses':
                    return view('main_template.pages.search')
                        ->with('courses', $this->getCourses($search_for))
                        ->with('breadcrumbs', $breadcrumbs)
                        ->with('search_in', $search_in)
                        ->with('search_for', $search_for);
                    break;
                case 'news' :
                    return view('main_template.pages.search')
                        ->with('news', $this->getNews($search_for))
                        ->with('breadcrumbs', $breadcrumbs)
                        ->with('search_in', $search_in)
                        ->with('search_for', $search_for);
                    break;
                case  'article':
                    return view('main_template.pages.search')
                        ->with('articles', $this->getArticles($search_for))
                        ->with('breadcrumbs', $breadcrumbs)
                        ->with('search_in', $search_in)
                        ->with('search_for', $search_for);
                    break;
                default:
                    $news = $this->getNews($search_for);
                    $courses = $this->getCourses($search_for);
                    $articles = $this->getArticles($search_for);

                    $c = count($news);
                    $active ='news';
                    if(count($courses)>$c){
                        $c = count($courses);
                        $active = 'courses';
                    }
                    if(count($articles)>$c) {
                        $active = 'articles';
                    }

                    return view('main_template.pages.search')
                        ->with('news', $news)
                        ->with('courses', $courses)
                        ->with('articles', $articles)
                        ->with('breadcrumbs', $breadcrumbs)
                        ->with('search_in', $active)
                        ->with('search_for', $search_for);
            }
        }

        return view('main_template.pages.search')
            ->with('news', null)
            ->with('courses', null)
            ->with('articles', null)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('active_tab', null)
            ->with('search_for', $search_for);
    }

    public function getArticles($search_for)
    {
        $this->setQuery();
        $articles = $this->getQuery()
            ->whereType('article')
            ->where('lang', session('lang'))
            ->where('title', 'like', '%' . $search_for . '%')
            ->orWhere('summary', 'like', '%' . $search_for . '%')
            ->orWhere('text', 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->select('id', 'title', 'image', 'logo', 'created_at', 'type')->take(12)->get();

        return $articles;
    }

    public function getNews($search_for)
    {

        $this->setQuery();
        $news = $this->getQuery()
            ->whereType('news')
            ->where('lang', session('lang'))
            ->where('title', 'like', '%' . $search_for . '%')
            ->orWhere('summary', 'like', '%' . $search_for . '%')
            ->orWhere('text', 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->select('id', 'title', 'image', 'logo', 'created_at', 'type')->take(12)->get();

        return $news;
    }

    public function getCourses($search_for)
    {
        $courses = Course::where('lang', session('lang'))
            ->where('status', 1)
            ->where('title_' . session('lang'), 'like', '%' . $search_for . '%')
            ->orWhere('description_' . session('lang'), 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->take(12)->get();

        return $courses;
    }
}
