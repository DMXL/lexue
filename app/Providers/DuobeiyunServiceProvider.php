<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 8/07/16
 * Time: 1:34 PM
 */

namespace App\Providers;


use App\Services\Duobeiyun\DuobeiyunApi;
use Illuminate\Support\ServiceProvider;

class DuobeiyunServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->bind('duobeiyun', function() {
            return new DuobeiyunApi();
        });
    }
}