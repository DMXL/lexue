<?php

namespace App\Providers;

use App\Services\PageGenerator;
use App\Services\Duobeiyun\DuobeiyunApi;
use App\Services\Wechat\NotificationPusher;
use App\Services\Wechat\PaymentHandler;
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

        // Wechat Notification Pusher
        $this->app->singleton('wechat.pusher', function() {
            return new NotificationPusher();
        });

        // Wechat Payment Handler
        $this->app->singleton('wechat.cashier', function() {
            return new PaymentHandler();
        });
    }
}
