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
| Log viewer routes
|--------------------------------------------------------------------------
*/
Route::get('all', ['domain' => appDomain('logs'), 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);

/*
|--------------------------------------------------------------------------
| Wechat routes
|--------------------------------------------------------------------------
*/
Route::group(['domain' => appDomain('wechat')], function() {
    include app_path('Http' . DIRECTORY_SEPARATOR . 'Routes' . DIRECTORY_SEPARATOR . 'wechat.php');
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
/* Web */
Route::group(['domain' =>  appDomain('students'), 'as' => 'students::', 'namespace' => 'Student', 'middlewareGroups' => 'web'], function() {
    include app_path('Http' . DIRECTORY_SEPARATOR . 'Routes' . DIRECTORY_SEPARATOR . 'students.php');
});

/* weChat */
Route::group(['domain' =>  appDomain('m.students'), 'as' => 'wechat::', 'namespace' => 'Student', 'middlewareGroups' => 'web'], function() {
    include app_path('Http' . DIRECTORY_SEPARATOR . 'Routes' . DIRECTORY_SEPARATOR . 'students.php');
});


/**
 * Teacher specific routes
 */
Route::group(['domain' =>  appDomain('teachers'), 'as' => 'teachers::', 'namespace' => 'Teacher', 'middleware' => ['web','auth:teachers']], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'MainController@index']);

    Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'MainController@index']);

        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    });

    Route::resource('lectures', 'LectureController');
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