<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 9:56 PM
 */

Route::get('/', ['as' => 'home', 'uses' => 'MainController@index']);

Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'MainController@index']);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
});

Route::resource('lectures', 'LectureController');