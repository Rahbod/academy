<?php

namespace Appnegar\Cms\Providers;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //dd(__DIR__);
//       require __DIR__.'\routes\route.php';
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'appnegar');


    }
}
