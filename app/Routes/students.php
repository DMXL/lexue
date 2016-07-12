<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 12/07/16
 * Time: 4:06 PM
 */
Route::resource('teachers', 'TeacherController', ['only' => ['index', 'show']]);

Route::group(['middleware' => 'auth:students'], function(){
    Route::get('/', 'MainController@index');
    Route::get('profile', ['as' => 'profile.get', 'uses' => 'MainController@profile']);

    Route::post('teachers/{id}/book', ['as' => 'teachers.book', 'uses' => 'TeacherController@book'] );

    Route::resource('lectures', 'LectureController', ['only' => ['index', 'show']]);
});