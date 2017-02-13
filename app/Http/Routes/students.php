<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 12/07/16
 * Time: 4:06 PM
 */

/*
|--------------------------------------------------------------------------
| Everything here is in "(m.)students.<domain>"
|--------------------------------------------------------------------------
*/

// The standalone pages
Route::get('about', ['as' => 'about', 'uses' => function(){
    return view('wechat.about');
}]);
Route::get('contact', ['as' => 'contact', 'uses' => function(){
    return 'contact';
}]);

Route::resource('teachers', 'TeacherController', ['only' => ['index', 'show']]);

Route::group(['middleware' => 'auth:students'], function(){
    Route::get('/', 'MainController@index');

    Route::get('profile', ['as' => 'profile.get', 'uses' => 'MainController@profile']);

    Route::post('teachers/{id}/book', ['as' => 'teachers.book', 'uses' => 'TeacherController@book']);

    // Lectures related
    Route::resource('lectures', 'LectureController', ['only' => ['show','index'], 'parameters' => 'singular']);
    Route::post('lectures/{id}/book', ['as' => 'lectures.book', 'uses' => 'LectureController@book']);
    Route::get('lectures/room/{id}', ['as' => 'lectures.room', 'uses' => 'LectureController@showRoom']);
    Route::get('replays', ['as' => 'lectures.replays', 'uses' => 'LectureController@replays']);

    // Tutorials
    Route::resource('tutorials', 'TutorialController', ['only' => ['show', 'index']]);

    // Orders related
    Route::get('orders/pay/{id}', ['as' => 'orders.pay', 'uses' => 'OrderController@pay']);
    Route::get('orders/result/{id}', ['as' => 'orders.result', 'uses' => 'OrderController@displayResult']);
});