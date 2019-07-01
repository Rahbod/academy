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
//        dd('hi');
        // Using class based composers...
        $global_views = [
            'errors.404',
            'errors.500',

            'auth.passwords.email',
            'auth.passwords.reset',

            'auth.login',
            'auth.register',
            'auth.verify',

            'main_template.master_page.master',

            'main_template.modules.header',

            'main_template.pages.courses.course-registration',
            'main_template.pages.courses.index',
            'main_template.pages.courses.show',
            'main_template.pages.courses.verify',

            'main_template.pages.news.index',
            'main_template.pages.news.show',

            'main_template.pages.about-us',
            'main_template.pages.contact-us',
            'main_template.pages.home',
            'main_template.pages.message',
            'main_template.pages.search',
            'main_template.pages.translation',

            'main_template.pages.static_pages.test',

        ];
        View::composer($global_views, 'App\Http\View\Composer\Menus');

    }

    public function register()
    {
        //
    }

}