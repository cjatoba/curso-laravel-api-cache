<?php

namespace App\Providers;

use App\Models\{
    Course,
    Module
};
use App\Observers\{
    CourseObserver,
    ModuleObserver
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Course::observe(CourseObserver::class);
        Module::observe(ModuleObserver::class);
    }
}
