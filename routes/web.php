<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'WelcomeController@index');

Route::prefix('api')->middleware(['auth'])->group(function() {
    
    //news
    Route::get('/all-news', 'NewStaffController@all_news');
    Route::post('/news', 'NewStaffController@store_news');
    Route::patch('/news/{id}', 'NewStaffController@update_news');
    Route::delete('/news/{id}', 'NewStaffController@delete_news');
    //staff
    Route::get('/all-staff', 'NewStaffController@all_staff');
    Route::post('/staff', 'NewStaffController@store_staff');
    Route::patch('/staff/{id}', 'NewStaffController@update_staff');
    Route::delete('/staff/{id}', 'NewStaffController@delete_staff');
    //forum
    Route::get('/all-post', 'forumController@all_post');
    Route::post('/post', 'forumController@store_post');
    Route::delete('/post/{id}', 'forumController@delete_post');

    //test paper
    Route::get('/teacherdashboard', 'TeacherDashboardController@index');
    Route::get('/set_update_testpaper/{id}', 'TeacherDashboardController@set_update_testpaper');
    Route::post('/testpaper', 'TeacherDashboardController@create_testpaper');
    Route::delete('/testpaper/{id}', 'TeacherDashboardController@delete_testpaper');
    Route::patch('/testpaper', 'TeacherDashboardController@update_testpaper');

    //student
    Route::get('/studentdashboard', 'StudentDashboardController@index');
    Route::get('/set_test', 'WriteTestController@set_test');
    Route::post('/submit_test', 'WriteTestController@submit_test');

    //  site management
    Route::get('/sitemanagement/loadpage', 'SiteManagementController@loadpage');
    // user
    Route::delete('/user/{id}', 'UserController@delete');
    Route::get('/user/block/{id}', 'UserController@block');
    Route::patch('/user', 'UserController@update');
});


Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/sitemanagement', 'SiteManagementController@index');
    Route::get('/pastquestion', 'PastQuestionController@index');
    Route::get('/newstaff', 'NewStaffController@index');
    Route::get('/forum-page', 'ForumController@index');
    Route::get('/testreport', 'TestReportController@index');
    Route::get('/write_test','writeTestController@index');
    Route::get('/results/{id}','TeacherDashboardController@testpaper_results');
});
Route::get('/test', function(){
    return view("test");
});

Auth::routes();

// Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);


// Route::any('{query}',function(){
//     return view('pagenotfound');
// })->where('query','.*');