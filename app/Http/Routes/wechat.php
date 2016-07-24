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


/* General requests - no names needed */
Route::get('/wechat', 'WechatController@verify');
Route::post('/wechat', ['as' => 'user_request', 'uses' => 'WechatController@serve']);

/* Get menu */
Route::get('wechat/menu', ['as' => 'menu', 'uses' => 'WechatController@menu']);

/*
 * OAuth
 */
Route::get('wechat/auth', ['as' => 'auth.redirect', 'uses' => 'Auth\WechatAuthController@redirectToProvider']);
Route::get('wechat/auth/callback', ['as' => 'auth.callback', 'uses' => 'Auth\WechatAuthController@handleProviderCallback']);