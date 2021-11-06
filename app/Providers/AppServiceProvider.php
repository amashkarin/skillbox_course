<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Service\ModelCacheService;
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
        \View::composer('layout.aside', function ($view) {

            $modelCacheService = resolve(ModelCacheService::class);
            /**
             * @var ModelCacheService $modelCacheService
             */
            $tagModel = new Tag();
            $tagsCloud = \Cache::tags($modelCacheService->getListCacheTag($tagModel))
                ->rememberForever($modelCacheService->getListCacheKey($tagModel), function () {
                    return Tag::get();
                });
            $view->with('tagsCloud', $tagsCloud);
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
