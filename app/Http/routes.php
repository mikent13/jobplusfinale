<?php

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

Route::get('/', function () {
    return view('login.login');
});

Route::get('register', ['as' => 'login.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@register']);


Route::auth();

Route::group(['middleware' => ['web']], function(){

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/user/home', [
	'uses' => 'UserController@getHome',
	'as' => 'user/home'
	])->middleware('auth');

Route::get('/user/setup', [
	'uses' => 'UserController@getSetup',
	'as' => 'user/setup'
	])->middleware('auth');

Route::post('/setup/save', [
	'uses' => 'UserController@saveData',
	'as' => 'save'
	])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
*/

Route::get('/employer',[
	'uses' => 'EmployerController@index',
	'as' => 'employer'
	])->middleware('auth');

	Route::get('/employer/test/{id}', [
	'uses' => 'EmployerController@test',
	'as' => 'test'
	])->middleware('auth');

	Route::get('/employer/dashboard', [
	'uses' => 'EmployerController@getDashboard',
	'as' => 'emp/dashboard'
	])->middleware('auth');

	Route::get('/employer/jobpost', [
	'uses' => 'EmployerController@getJobPost',
	'as' => 'emp/job/post'
	])->middleware('auth');


Route::get('employer/profile/{id}', [
	'uses' => 'EmployerController@getProfile',
	'as' => 'emp/profile'
	])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Applicant Routes
|--------------------------------------------------------------------------
*/

Route::get('/applicant/dashboard', [
	'uses' => 'ApplicantController@getDashboard',
	'as' => 'app/dashboard'
	])->middleware('auth');


Route::post('/applicant/job', [
	'uses' => 'ApplicantController@getJobPage',
	'as' => 'app/job/result'
	])->middleware('auth');

Route::get('/applicant/jobsearch', [
	'uses' => 'ApplicantController@getJobSearch',
	'as' => 'app/job/search'
	])->middleware('auth');

Route::get('/applicant/apply',[
	'uses' => 'ApplicantController@getApply',
	'as' => 'app/apply'
	])->middleware('auth');

Route::get('applicant/profile/{id}', [
	'uses' => 'ApplicantController@getProfile',
	'as' => 'app/profile'
	])->middleware('auth');

});