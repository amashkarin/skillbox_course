<?php

namespace App\Providers;

use App\Service\PushAllService;
use Illuminate\Support\ServiceProvider;

class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PushAllService::class, function ($app) {
            return new PushAllService(
                config('services.push_all.id'),
                config('services.push_all.key'),
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
