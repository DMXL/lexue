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
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['domain' => '{user_type}.' . appDomain()], function(){
    /**
     * Auth routes
     */
    $this->get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
    $this->post('login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@login']);
    $this->get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    // Registration Routes...
    $this->get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
    $this->post('register', ['as' => 'register.post', 'uses' => 'Auth\AuthController@register']);

    // Password Reset Routes...
    $this->get('password/reset/{token?}', ['as' => 'reset', 'uses' => 'Auth\PasswordController@showResetForm']);
    $this->post('password/email', ['as' => 'reset.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
    $this->post('password/reset', ['as' => 'reset.post', 'uses' => 'Auth\PasswordController@reset']);
});

/**
 * Teacher specific routes
 */
Route::group(['domain' =>  appDomain('teachers'), 'as' => 'teachers::', 'namespace' => 'Teacher', 'middleware' => ['web','auth:teachers']], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@show']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
});


Route::get('/home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Debug and Testing routes
|--------------------------------------------------------------------------
|
*/
Route::get('debug', function() {
    $teachers = App\Models\User\Teacher::all();
    return view('debug.index', compact('teachers'));
});