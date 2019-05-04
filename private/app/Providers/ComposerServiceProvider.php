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

        View::composer('*','App\Http\View\Composer\Menus');

    }

    public function register()
    {
        //
    }
}