<?php

namespace App\Providers;

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
        $app = $this->app;

        if ($app->environment() === 'local') {
            $app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
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
