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


/*
 * General requests - no names needed
 */
Route::get('weixin', ['as' => 'verify', 'uses' => 'WechatController@verify']);
Route::post('weixin', ['as' => 'user_request', 'uses' => 'WechatController@serve']);

/*
 * Server side tools - normally they are POST requests sent to Wechat server
 */

/* Set menu */
Route::get('weixin/menu', ['as' => 'menu', 'uses' => 'WechatController@menu']);

/* Set industry */
Route::get('weixin/industry', ['as' => 'industry', 'uses' => 'WechatController@industry']);

/*
 * OAuth
 */
Route::get('weixin/auth', ['as' => 'auth.redirect', 'uses' => 'Auth\WechatAuthController@redirectToProvider']);
Route::get('weixin/auth/callback', ['as' => 'auth.callback', 'uses' => 'Auth\WechatAuthController@handleProviderCallback']);