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
Route::get('/', 'WechatController@verify');
Route::post('/', 'WechatController@serve');

/* Get menu */
Route::get('menu', ['as' => 'menu', 'uses' => 'WechatController@menu']);

/*
 * OAuth
 */
Route::get('auth', ['as' => 'auth.redirect', 'uses' => 'Auth\AuthController@redirectToProvider']);
Route::get('auth/callback', ['as' => 'auth.callback', 'uses' => 'Auth\AuthController@handleProviderCallback']);