<?php

/*
 * Test routes
 */
Route::group(['domain' => appDomain()], function() {
    Route::get('test/{segment}', function () {
        return Request::getHost();
    });

    Route::get('/', function () {
        return 'home page of the home pages';
    });
});

/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
*/

Route::group(['domain' => '{user_type}.' . appDomain(), 'as' => 'auth::'], function(){
    /**
     * Auth routes
     */
    $this->get('login', ['as' => 'login.get', 'uses' => 'Auth\AuthController@showLoginForm']);
    $this->post('login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@login']);
    $this->get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    // Registration Routes...
    $this->get('register', ['as' => 'register.get', 'uses' => 'Auth\AuthController@showRegistrationForm']);
    $this->post('register', ['as' => 'register.post', 'uses' => 'Auth\AuthController@register']);

    // Password Reset Routes...
    $this->get('password/reset/{token?}', ['as' => 'reset.get', 'uses' => 'Auth\PasswordController@showResetForm']);
    $this->post('password/email', ['as' => 'reset.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
    $this->post('password/reset', ['as' => 'reset.post', 'uses' => 'Auth\PasswordController@reset']);
});

/*
|--------------------------------------------------------------------------
| Application routes
|--------------------------------------------------------------------------
*/

/**
 * Student specific routes
 */
Route::group(['domain' =>  appDomain('students'), 'as' => 'students::', 'namespace' => 'Student', 'middlewareGroups' => 'web'], function() {

    Route::resource('teachers', 'TeacherController', ['only' => ['index', 'show']]);

    Route::group(['middleware' => 'auth:students'], function(){
        Route::get('/', 'MainController@index');
        Route::get('profile', ['as' => 'profile.get', 'uses' => 'MainController@profile']);

        Route::post('teachers/{id}/book', ['as' => 'teachers.book', 'uses' => 'TeacherController@book'] );

        Route::resource('lectures', 'LectureController', ['only' => ['index', 'show']]);
    });
});

/**
 * Teacher specific routes
 */
Route::group(['domain' =>  appDomain('teachers'), 'as' => 'teachers::', 'namespace' => 'Teacher', 'middlewareGroups' => ['web','auth:teachers']], function() {
    Route::get('/', 'MainController@index');

    Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'MainController@index']);

        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    });
});

/**
 * Image routes
 */
Route::get('{image_type}/{file}', function(
    Illuminate\Http\Request $request,
    \App\Services\Image\DropboxImageHandler $imageHandler,
    $imageType, $file) {
    $imageHandler->get($request, $imageType, $file);
})->where(['file' => '.*']);

Route::get('default/{file}', function(
    Illuminate\Http\Request $request,
    \App\Services\Image\LocalImageHandler $imageHandler,
    $path) {
    $imageHandler->getDefault($request, $path);
});

/*
|--------------------------------------------------------------------------
| Debug and Testing routes
|--------------------------------------------------------------------------
*/
Route::get('debug', function() {
    return view('debug');
});