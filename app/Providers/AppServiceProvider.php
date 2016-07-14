<?php

namespace App\Providers;

use App\Services\PageGenerator;
use App\Services\Duobeiyun\DuobeiyunApi;
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

        if (\App::environment() === 'local') {
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
        // Duobeiyun
        $this->app->singleton('duobeiyun', function() {
            return new DuobeiyunApi();
        });

        // BCT Generator
        $this->app->singleton('page', function() {
            return new PageGenerator();
        });
    }
}
