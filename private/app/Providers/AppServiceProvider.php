<?php

namespace App\Providers;

use App\Action;
use App\Book;
use App\BookConcordance;
use App\Department;
use App\Observers\ActionObserver;
use App\Observers\BookConcordanceObserver;
use App\Observers\BookObserver;
use App\Observers\DepartmentObserver;
use App\Observers\PathObserver;
use App\Observers\ResourceGroupObserver;
use App\Observers\ResourceObserver;
use App\Observers\SettingGroupObserver;
use App\Observers\SettingObserver;
use App\Path;
use App\Resource;
use App\ResourceGroup;
use App\Setting;
use App\SettingGroup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Department::observe(DepartmentObserver::class);
        ResourceGroup::observe(ResourceGroupObserver::class);
        Resource::observe(ResourceObserver::class);
        Action::observe(ActionObserver::class);
        SettingGroup::observe(SettingGroupObserver::class);
        Setting::observe(SettingObserver::class);
        Path::observe(PathObserver::class);
//        Book::observe(BookObserver::class);
//        BookConcordance::observe(BookConcordanceObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
