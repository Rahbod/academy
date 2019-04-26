<?php namespace App\Traits;

use App\Category;

trait SetCategoriesTrait
{
    function setCategories()
    {
        $categories = Category::whereLang(session('lang','fa'))->whereStatus(1)->whereNull('parent_id')->get()->pluck('id', 'special_name')->toArray();
//        dd($categories);
        session(['categories' => $categories]);
    }
}