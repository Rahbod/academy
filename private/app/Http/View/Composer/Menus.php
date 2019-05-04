<?php

namespace App\Http\View\Composer;


use App\StaticMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class Menus
{
    /**
     * The user repository implementation.
     *
     * @var $categories
     */
    protected $main_menus;
    protected $menus;


    public function __construct()
    {
//        Cache::flush();
//        $this->main_menus = Cache::remember('main_menus', 5000, function () {
//            $static_menu = StaticMenu::with(['page' => function ($q) {
//                $q->where('status', 1)->where('lang', session('lang'))->orderBy('order')->select('id', 'title');
//            }])->where('status', 1)
//                ->where('lang', session('lang'))->orderBy('order')
//                ->get()->toTree();
//            return $static_menu;
//        });

//        $value = Cache::get('main_menus');
//        dd($this->main_menus);

    }

    public function compose(View $view)
    {
//        $view->with('main_menus', $this->main_menus);
    }
}