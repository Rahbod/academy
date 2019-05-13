<?php

namespace App\Http\Controllers;

use App\Content;
use App\Course;
use App\Tag;
use App\TranslateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public $lang;
    protected $query;

    public function __construct()
    {
//        $this->lang = session('lang');
        $this->lang = 'en';
        $this->setQuery();
    }

    public function setQuery($column_name = 'id')
    {
        $this->query = Content::query();
        $this->query->where('status', 1)->where('lang', $this->lang)
            ->orderBy($column_name)->where(function ($q2) {
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

        $contents = $this->query->whereType($content_type_name)->with('author')->paginate(6);

        $this->setQuery('created_at');
        $recent_contents = $this->query->whereType($content_type_name)->take(3)->get();

        return view('main_template.pages.news.index')->with('contents', $contents)->with('recent_posts', $recent_contents);
    }

    public function show($id)
    {
        $content = Content::with(['tags', 'author'])->findOrFail($id);
//        $content = Content::with('tags')->with('author')
//            ->with(['comments' => function ($q) {
//                $q->where('status', 1)->where('lang', $this->lang)->with('author')->with('children.children');
//            }])->findOrFail($id);

        $tags_id = $content->tags->pluck('id');

        $related_contents = Tag::with(['contents' => function ($q) use ($content) {
            $q->where('id', '!=', $content->id);
        }])->whereIn('id', $tags_id)->get();

        return view('main_template.pages.news.show')->with('content', $content)->with('related_contents', $related_contents);
    }

    public function search(Request $request)
    {
        $search_for = $request->search_query;

        if ($search_for) {
            $news = null;
            $courses = null;
            $translations = null;
            $articles = null;

            return view('main_template.pages.search')
                ->with('news', $this->getNews($search_for))
                ->with('courses', $this->getCourses($search_for))
                ->with('translations', $this->getTranslations($search_for))
                ->with('articles', $this->getArticles($search_for))
                ->with('search_for', $search_for);
        }

        return view('main_template.pages.search')
            ->with('news', null)
            ->with('courses', null)
            ->with('translations', null)
            ->with('articles', null)
            ->with('search_for', $search_for);
    }

    public function getArticles($search_for)
    {
        $this->setQuery();
        $articles = $this->query->whereType('article')
            ->where('title', 'like', '%' . $search_for . '%')
            ->orWhere('summary', 'like', '%' . $search_for . '%')
            ->orWhere('text', 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->select('id', 'title', 'image', 'logo', 'created_at')->take(12)->get();

        return $articles;
    }

    public function getNews($search_for)
    {

        $this->setQuery();
        $news = $this->query->whereType('news')
            ->where('title', 'like', '%' . $search_for . '%')
            ->orWhere('summary', 'like', '%' . $search_for . '%')
            ->orWhere('text', 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->select('id', 'title', 'image', 'logo', 'created_at')->take(12)->get();

        return $news;
    }

    public function getCourses($search_for)
    {
        $courses = Course::where('lang', $this->lang)
            ->where('status', 1)
            ->where('title', 'like', '%' . $search_for . '%')
            ->orWhere('description', 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->take(12)->get();

        return $courses;
    }

    public function getTranslations($search_for)
    {
        $translations = TranslateRequest::where('lang', $this->lang)
            ->where('status', 1)
            ->where('price', '!=', null)
            ->where('title', 'like', '%' . $search_for . '%')
            ->orWhere('description', 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->take(12)->get();

        return $translations;
    }
}
