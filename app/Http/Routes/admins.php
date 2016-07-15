<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 10:05 PM
 */

Route::get('/', ['as' => 'home', 'uses' => 'MainController@index']);

Route::resource('teachers', 'TeacherController');

Route::resource('lectures', 'LectureController');