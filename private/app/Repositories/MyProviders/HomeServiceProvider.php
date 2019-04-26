<?php

namespace App\Repositories\MyProviders;

//use IlluminateSupportServiceProvider;
use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Interfaces\HomeInterface', 'App\Repositories\HomeRepository');
    }
}

