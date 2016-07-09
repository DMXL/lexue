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
Route::group(['domain' =>  appDomain('students'), 'as' => 'students::', 'namespace' => 'Student', 'middleware' => ['web','auth:students']], function() {
    Route::get('/', 'MainController@index');

    Route::resource('teachers', 'TeacherController', ['only' => ['index', 'show']]);
});

/**
 * Teacher specific routes
 */
Route::group(['domain' =>  appDomain('teachers'), 'as' => 'teachers::', 'namespace' => 'Teacher', 'middleware' => ['web','auth:teachers']], function() {
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
Route::get('avatar/{user_type}/{id}/{file}', function(
    Illuminate\Http\Request $request,
    \App\Services\Image\LocalImageHandler $imageHandler,
    $userType, $userId, $file) {
    $imageHandler->getAvatar($request, $userType, $userId, $file);
});

Route::get('default/{file}', function(Illuminate\Http\Request $request, \App\Services\Image\LocalImageHandler $localImageHandler, $path) {
    $localImageHandler->getDefault($request, $path);
});

/*
|--------------------------------------------------------------------------
| Debug and Testing routes
|--------------------------------------------------------------------------
*/
Route::get('debug', function() {
    return view('debug');
});