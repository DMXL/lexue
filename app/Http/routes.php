<?php

/*
 * Test routes
 */
Route::group(['domain' => appDomain()], function() {
    Route::get('test/{segment}', function () {
        return Request::getHost();
    });

    Route::get('/', function() {
        return 'home page of the home pages';
    });

    Route::get('logs', ['uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);
});

/*
|--------------------------------------------------------------------------
| Log viewer routes
|--------------------------------------------------------------------------
*/
Route::get('logs', ['uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);

/*
|--------------------------------------------------------------------------
| Wechat routes
|--------------------------------------------------------------------------
*/
Route::group(['domain' => appDomain('m.students'), 'as' => 'wechat::'], function() {
    include routeFile('wechat.php');
});

/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
*/

Route::group(['domain' => '{user_type}.' . appDomain(), 'as' => 'auth::'], function(){
    include routeFile('auth.php');
});

/*
|--------------------------------------------------------------------------
| Application routes
|--------------------------------------------------------------------------
*/

/*
 * Student specific routes
 */
/* Web */
Route::group(
    [
        'domain' =>  appDomain('students'),
        'as' => 'students::',
        'namespace' => 'Student'
    ],
    function() {
        include routeFile('students.php');
    }
);

/* weChat */
Route::group(
    [
        'domain' =>  appDomain('m.students'),
        'as' => 'm.students::',
        'namespace' => 'Student',
        'middleware' => 'auth.wechat:students'
    ],
    function() {
        include routeFile('students.php');
    }
);


/*
 * Teacher specific routes
 */
Route::group(
    [
        'domain' =>  appDomain('teachers'),
        'as' => 'teachers::',
        'namespace' => 'Teacher',
        'middleware' => 'auth:teachers'
    ],
    function() {
        include routeFile('teachers.php');
    }
);

/*
 * Admin specific routes
 */
Route::group(
    [
        'domain' =>  appDomain('admins'),
        'as' => 'admins::',
        'namespace' => 'Admin',
        'middleware' => 'auth:admins'
    ],
    function() {
        include routeFile('admins.php');
    }
);

/*
 * Video routes
 */
Route::get('video/{path}', function($path) {
    $fileContents = Storage::disk('video')->get($path);

    $response = Response::make($fileContents, 200);

    if (preg_match('/\.(\w+)$/', $path, $matches)) {
        $response->header('Content-Type', "video/" . $matches[1]);
    }

    return $response;
})->where(['path' => '.*']);

/*
|--------------------------------------------------------------------------
| Debug and Testing routes
|--------------------------------------------------------------------------
*/
Route::get('debug', ['as' => 'debug' , 'uses' => function() {
    return view('debug');
}]);

Route::get('debug/teachers/{id}/timetable', function($id){
    dd(\App\Models\User\Teacher::find($id)->getTimetable());
});
