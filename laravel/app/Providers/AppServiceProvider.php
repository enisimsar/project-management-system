<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('manager.parent', function ($view) {
            $view->with([
                'authUser' =>  Auth::guard('web')->user(),
            ]);
        });

        view()->composer('admin.parent', function ($view) {
            $view->with([
                'authUser' =>  Auth::guard('admin')->user(),
            ]);
        });
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
