<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    'as' => 'home.get.index', 'uses' => 'HomeController@index'
]);

// Route::get('/test', [
//     'as' => 'home.get.test', 'uses' => 'HomeController@test'
// ]);

Route::post('/', [
    'as' => 'home.post.subscribe', 'uses' => 'HomeController@subscribe'
]);

Route::get('/unsubscribe/{token}', [
    'as' => 'home.get.unsubscribe', 'uses' => 'HomeController@unsubscribe'
]);

Route::get('/email', [
    'as' => 'home.get.email', 'uses' => 'HomeController@email'
]);

Route::get('/s/{uuid}', ['as' => 'home.get.shortcut', 'uses' => 'HomeController@shortcut']);

Route::post('/update-views', ['as' => 'home.post.views', 'uses' => 'HomeController@updateViews']);


//Recruiter controller
Route::get('/poster-un-job/{token?}', [
    'as' => 'recruiter.get.index', 'uses' => 'RecruiterController@index'
]);


Route::post('/job', [
    'as' => 'recruiter.post.job', 'uses' => 'RecruiterController@postJob'
]);

Route::get('/edit-job/{token}', [
    'as' => 'recruiter.get.show.job', 'uses' => 'RecruiterController@showJob'
]);

Route::post('/edit-job/{token}', [
    'as' => 'recruiter.update.job', 'uses' => 'RecruiterController@updateJob'
]);




Route::prefix('bo/')->group(function () {
    Route::get('login', ['as' => 'bo.login.index', 'uses' => 'Auth\LoginController@index']);
    Route::post('login', ['as' => 'bo.login.post', 'uses' => 'Auth\LoginController@login']);

    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', ['as' => 'bo.dashboard.index', 'uses' => 'Auth\DashboardController@index']);
        Route::post('dashboard/validate', ['as' => 'bo.dashboard.manage', 'uses' => 'Auth\DashboardController@manageJob']);
        Route::post('dashboard/update-type', ['as' => 'bo.dashboard.updatetype', 'uses' => 'Auth\DashboardController@updateType']);
    });
});




Route::prefix('api/')->group(function () {
    Route::get('podium', ['as' => 'api..get.podium', 'uses' => 'ApiController@index']);
});
