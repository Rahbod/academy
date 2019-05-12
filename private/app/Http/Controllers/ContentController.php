<?php

namespace App\Http\Controllers;

use App\Content;
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
        $this->query->where('status', 1)->where('lang', $this->lang)->orderBy($column_name);
    }

    public function index()
    {
        $url_array = explode('/', request()->fullUrl());
        $content_type_name = $url_array[count($url_array) - 1];

        $contents = $this->query->whereType($content_type_name)->with('author')->paginate(5);
//        dd($contents);
        $this->setQuery('created_at');
        $recent_contents = $this->query->whereType($content_type_name)->take(3)->get();

        return view('main_template.pages.news.index')->with('contents', $contents)->with('recent_posts', $recent_contents);
    }

    public function articles()
    {
        return view('main_template.pages.news.index');
    }

    public function show($id = null)
    {
        return view('main_template.pages.news.show');
    }

    public function showSearchResults(Request $request)
    {
        $search_for = $request->search_query;

        if ($search_for) {
            $contents = null;

            return view('main_template.pages.search.search')
                ->with('contents', $this->getContents($search_for))
                ->with('search_for', $search_for);
        }
        return view('main_template.pages.search.search')
            ->with('contents', null)
            ->with('search_for', $search_for);
    }

    public function getContents($search_for)
    {
        $contents = Content::where('lang', session('lang'))->where('status', 1)->where('title', 'like', '%' . $search_for . '%')
            ->orWhere('summary', 'like', '%' . $search_for . '%')
            ->orWhere('text', 'like', '%' . $search_for . '%')
            ->orderBy('created_at', 'desc')->select('id', 'title', 'image', 'logo', 'created_at')->take(12)->get();

//        foreach ($contents as $key => $content) {
//            if (strpos($content->title, $search_for) > 0) {
//                $content->title = $this->insertTooltip($content->title, $search_for);
//            }
//        }
        return $contents;
    }


}
