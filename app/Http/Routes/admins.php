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
Route::post('lectures/{id}/thumb', ['as' => 'lectures.thumb.upload', 'uses' => 'LectureController@uploadThumb']);
Route::put('lectures/{id}/enable', ['as' => 'lectures.enable', 'uses' => 'LectureController@enable']);
Route::put('lectures/{id}/disable', ['as' => 'lectures.disable', 'uses' => 'LectureController@disable']);

Route::resource('timeslots', 'TimeSlotController');
Route::get('timetables', ['as' => 'timetables.index', 'uses' => 'TimetableController@index']);

Route::resource('teachers.timeslots', 'TeacherTimeSlotController', ['only' => ['store']]);
Route::resource('teachers.offtimes', 'OffTimeController', ['only' => ['store', 'destroy']]);
Route::get('teachers/{teacher_id}/timetables', ['as' => 'teachers.timetables', 'uses' => 'TimetableController@showTeacher']);
Route::get('teachers/{teacher_id}/lectures', ['as' => 'teachers.lectures', 'uses' => 'LectureController@showTeacher']);
Route::get('teachers/{teacher_id}/timetable/{date}/snippet/{timeslot}', ['as' => 'teachers.timetable.snippet', 'uses' => 'TimetableController@showSnippet']);

Route::resource('schedules', 'ScheduleController');
Route::get('teachers/{teacher_id}/schedules', ['as' => 'teachers.schedules', 'uses' => 'ScheduleController@showTeacher']);