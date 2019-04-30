<?php

namespace App\Http\View\Composer;


use Cache;
use Illuminate\View\View;

class Menus
{
    /**
     * The user repository implementation.
     *
     * @var $categories
     */
    protected $categories_array = [];
    protected $book_category;
    protected $biography;
    protected $nav_news;

    public function __construct()
    {

//        $this->categories_array = Cache::remember('main_categories', config('cache.ttl'), function () {
//            $categories['audios']['name'] = trans('messages.main.audios');
//            $categories['audios']['address'] = 'audios';
//            $categories['audios']['items'] = $audiosCategory;
//
//            return $categories;
//        });

    }

    public function compose(View $view)
    {
//        $view->with('categories', $this->categories_array);
    }
}