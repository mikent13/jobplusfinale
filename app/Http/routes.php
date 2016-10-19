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
	'uses' => 'UserController@saveProfile',
	'as' => 'user/save'
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

	Route::get('/employer/test/{$id}', [
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


Route::get('employer/profile', [
	'uses' => 'EmployerController@getProfile',
	'as' => 'emp/profile'
	])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Applicant Routes
|--------------------------------------------------------------------------
*/

Route::get('/applicant/dashboard/', [
	'uses' => 'ApplicantController@getDashboard',
	'as' => 'app/dashboard'
	])->middleware('auth');


Route::get('/applicant/job', [
	'uses' => 'ApplicantController@getJobPage',
	'as' => 'app/job/result'
	])->middleware('auth');
Route::get('/app/job/filter','ApplicantController@getFilter');
Route::get('/app/job/getskill','ApplicantController@getSkills');
Route::get('/app/jobsearch', 'ApplicantController@getJobSearch');
Route::get('/get/jobdata','ApplicantController@getJobPageData');
Route::get('/get/job','ApplicantController@getResult');
Route::get('/app/apply','ApplicantController@Apply');
Route::get('/app/autocomplete',[
	'uses' => 'ApplicantController@getAuto',
	'as' => 'autocompletes']);

Route::get('applicant/profile', [
	'uses' => 'ApplicantController@getProfile',
	'as' => 'app/profile'
	])->middleware('auth');

Route::get('/applicant/job/start/{id}',[
	'uses' => 'ApplicantController@StartJob',
	'as' => 'app/job/start'
	])->middleware('auth');

Route::get('/applicant/job/end/{id}',[
	'uses' => 'ApplicantController@EndJob',
	'as' => 'app/job/end'
	])->middleware('auth');

Route::get('searchcomplete', 'ApplicantController@getAuto')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Job Routes
|--------------------------------------------------------------------------
*/

Route::get("/job/create", "jobController@create");
Route::post("job/store", "jobController@store");
Route::get("index", "jobController@index");
Route::get("show/{id}", "jobController@show");
Route::get("edit/{id}", "jobController@edit");
Route::patch("update/{id}", "jobController@update");
Route::get("delete/{id}", "jobController@destroy");

});