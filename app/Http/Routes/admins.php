<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 10:05 PM
 */

Route::get('/', ['as' => 'home', 'uses' => 'MainController@index']);

Route::resource('teachers', 'TeacherController');
Route::put('teachers/{id}/enable', ['as' => 'teachers.enable', 'uses' => 'TeacherController@enable']);
Route::put('teachers/{id}/disable', ['as' => 'teachers.disable', 'uses' => 'TeacherController@disable']);

Route::resource('lectures', 'LectureController');

Route::resource('timeslots', 'TimeSlotController');