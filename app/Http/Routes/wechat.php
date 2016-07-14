<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 2:18 PM
 */

/*
|--------------------------------------------------------------------------
| Everything here is in "wechat.<domain>"
|--------------------------------------------------------------------------
*/


/* Wechat - User Request */
Route::get('/', 'WechatController@verify');
Route::post('/', 'WechatController@serve');

/* Wechat - Menu */
Route::get('menu', 'WechatController@menu');