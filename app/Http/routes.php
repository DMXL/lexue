<?php

/*
 * Test routes
 */
Route::get('test/{segment}', function(){
    return Request::root();
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

Route::group(['domain' => '{user_type}.' . config('app.domain')], function(){

    /**
     * Auth routes
     */
    $this->get('login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@showLoginForm']);
    $this->post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@login']);
    $this->get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    // Registration Routes...
    $this->get('register', ['as' => 'getRegister', 'uses' => 'Auth\AuthController@showRegistrationForm']);
    $this->post('register', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@register']);

    // Password Reset Routes...
    $this->get('password/reset/{token?}', ['as' => 'getReset', 'uses' => 'Auth\PasswordController@showResetForm']);
    $this->post('password/email', ['as' => 'postResetEmail', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
    $this->post('password/reset', ['as' => 'postReset', 'uses' => 'Auth\PasswordController@reset']);

    /**
     * Dashboard
     */
    Route::group(['middleware' => ['web','auth']], function() {
        Route::get('/', function () {
            return view('welcome');
        });
    });
});


Route::get('/home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Debug and Testing routes
|--------------------------------------------------------------------------
|
*/
Route::get('debug', function() {
    $teachers = App\Models\Users\Teacher::all();
    return view('debug.index', compact('teachers'));
});