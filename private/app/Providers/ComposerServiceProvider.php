<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        $global_views = [
            'errors.404',
            'errors.500',

            'auth.login',
            'auth.register',

            'main_template.pages.comment.comment_form',
            'main_template.pages.comment.comment_list',

        ];

//        View::composer(
//            $global_views,
//            'App\Http\View\Composer\Categories'
//        );
//
//        View::composer('errors/404', function ($view) {
//            $last_news = \App\Content::where('lang', session('lang'))->where('status', 1)->where('is_news', 1)->take(15)->get();
////            dd($last_news);
//            $view->with('last_news', $last_news);
//        });

    }

    public function register()
    {
        //
    }
}