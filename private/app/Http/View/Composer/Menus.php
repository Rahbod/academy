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
        Cache::flush();

        $this->main_menus = Cache::remember('main_menus', 5000, function () {
            $lang = 'fa';

            $static_menu = StaticMenu::with(['page' => function ($q) use ($lang) {
                $q->where('status', 1)->where('lang', $lang)->orderBy('order')->select('id', 'title');
            }])->where('status', 1)->where('lang', $lang)->orderBy('order')
                ->get()->toTree();

            return $static_menu;
        });

    }

    public function compose(View $view)
    {
        $view->with('main_menus', $this->main_menus);
    }
}