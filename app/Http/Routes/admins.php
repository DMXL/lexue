<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 10:05 PM
 */

Route::get('/', ['as' => 'home', 'uses' => 'MainController@index']);

Route::resource('teachers', 'TeacherController');
Route::post('teachers/{id}/avatar', ['as' => 'teachers.avatar.upload', 'uses' => 'TeacherController@uploadAvatar']);
Route::post('teachers/{id}/video', ['as' => 'teachers.video.upload', 'uses' => 'TeacherController@uploadVideo']);
Route::put('teachers/{id}/enable', ['as' => 'teachers.enable', 'uses' => 'TeacherController@enable']);
Route::put('teachers/{id}/disable', ['as' => 'teachers.disable', 'uses' => 'TeacherController@disable']);

Route::resource('tutorials', 'TutorialController');
Route::resource('lectures', 'LectureController');
Route::get('teachers/{teacher_id}/lectures', ['as' => 'teachers.lectures.index', 'uses' => 'LectureController@showTeacher']);

Route::resource('timeslots', 'TimeSlotController');
Route::resource('teachers.timeslots', 'TeacherTimeSlotController', ['only' => ['index', 'store']]);

Route::resource('teachers.offtimes', 'OffTimeController', ['except' => ['show', 'create', 'edit']]);

Route::get('timetables', ['as' => 'timetables.index', 'uses' => 'TimetableController@index']);
Route::get('teachers/{teacher_id}/timetables', ['as' => 'teachers.timetables.index', 'uses' => 'TimetableController@showTeacher']);

Route::get('teachers/{teacher_id}/timetable/{date}/snippet/{timeslot}', ['as' => 'teachers.timetable.snippet', 'uses' => 'TimetableController@showSnippet']);