<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 26/07/16
 * Time: 9:50 AM
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class WechatPusher extends Facade
{
    protected static function getFacadeAccessor() { return 'wechat.pusher'; }
}