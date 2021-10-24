<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        \View::composer('layout.aside', function($view) {
            $view->with('tagsCloud', Tag::has('posts')->get());
        });

        \Blade::if('admin', function () {
            if (Auth::guest()) {
                return false;
            }
            return Auth::user()->isAdmin();
        });

        Paginator::useBootstrap();
    }
}
