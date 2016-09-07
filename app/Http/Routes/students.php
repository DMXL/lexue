<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 12/07/16
 * Time: 4:06 PM
 */
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

    Route::post('teachers/{id}/book', ['as' => 'teachers.book', 'uses' => 'TeacherController@book'] );

    Route::get('purchases', ['as' => 'purchases.index', 'uses' => 'PurchaseController@index']);
    Route::resource('lectures', 'LectureController', ['only' => ['show','index']]);
    Route::post('lectures/{id}/book', ['as' => 'lectures.book', 'uses' => 'LectureController@book'] );
    Route::resource('tutorials', 'TutorialController', ['only' => ['show','index']]);
    Route::resource('orders', 'OrderController', ['only' => ['show','index']]);
});