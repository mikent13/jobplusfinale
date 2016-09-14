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


Route::auth();



Route::get('/home', 'HomeController@index');



Route::group(['middleware' => ['web']], function(){
//Employer

Route::get('/employer',[
	'uses' => 'EmployerController@index',
	'as' => 'employer'
	])->middleware('auth');


//Applicant
Route::get('/applicant', [
	'uses' => 'ApplicantController@index',
	'as' => 'applicant'
	])->middleware('auth');

Route::get('/profile', [
	'uses' => 'ApplicantController@getProfile',
	'as' => 'profile'
	])->middleware('auth');

Route::get('/job', [
	'uses' => 'ApplicantController@getJob',
	'as' => 'job'
	])->middleware('auth');

Route::get('/jobsearch', [
	'uses' => 'ApplicantController@getJobSearch',
	'as' => 'jobsearch'
	])->middleware('auth');

Route::get('/applicant/{$jobid}/{$id}',[
	'uses' => 'ApplicantController@getApply',
	'as' => 'applicant.apply'
	])->middleware('auth');

});