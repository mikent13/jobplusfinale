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

Route::get('/get/checker/job','UserController@checkJob');
Route::get('/get/checker','UserController@checkPage');
Route::get('/get/checker/dummy','UserController@getJob');


Route::get('/get/rank','ApplicantController@getrank');
/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('/get/profile/skill','ProfileController@getSkill');
Route::get('/update/profile/skill','ProfileController@updateSkill');
Route::get('/set/user/profile/name','ProfileController@setName');
Route::get('/set/user/profile/overview','ProfileController@setOverview');
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/


Route::get('/user/home', [
	'uses' => 'UserController@getHome',
	'as' => 'user/home'
	])->middleware('auth');

Route::post('/user/upload', [
	'uses' => 'UserController@UploadImage',
	'as' => 'user/upload'
	])->middleware('auth');

Route::get('/user/setup', [
	'uses' => 'UserController@getSetup',
	'as' => 'user/setup'
	])->middleware('auth');

Route::get('/app/setup', [
	'uses' => 'UserController@getSetup',
	'as' => 'app/setup'
	])->middleware('auth');

Route::post('/setup/save', [
	'uses' => 'UserController@saveProfile',
	'as' => 'user/save'
	])->middleware('auth');

Route::get('/get/user/profile','UserController@getProfile');

Route::get('user/profile', [
	'uses' => 'UserController@getProfile',
	'as' => 'app/profile'
	])->middleware('auth');

Route::get('/get/user/setupdata', 'UserController@getSetupData');
Route::get('/get/user/degree', 'UserController@getDegree');

Route::get('/set/user/education','UserController@setEducation');
Route::get('/get/user/education','UserController@getEducation');
Route::get('/remove/user/education','UserController@removeEducation');
Route::get('/find/user/education','UserController@findEducation');
Route::get('/update/user/education','UserController@updateEducation');

Route::get('/set/user/step1','UserController@setStep1');

Route::get('/set/user/work','UserController@setWork');
Route::get('/get/user/work','UserController@getWork');
Route::get('/remove/user/work','UserController@removeWork');
Route::get('/find/user/work','UserController@findWork');
Route::get('/update/user/work','UserController@updateWork');

Route::get('/set/user/verify','UserController@setVerification');
Route::get('/get/user/verify','UserController@getVerification');

Route::get('/get/profiledata', 'UserController@getProfileData');
Route::get('/get/update/name', 'UserController@updateName');
Route::get('/admin','UserController@getAdmin');
Route::get('/sms','UserController@getSMSPage');
Route::get('/sms/send','UserController@ChikkaSend');
Route::post('/sms/receive','UserController@ChikkaReceive');

Route::get('/get/dash/resched','ApplicantController@setReschedule');

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

Route::get('/set/postjob','EmployerController@postJob');

Route::get('/employer/jobpost/data', [
	'uses' => 'EmployerController@getJobPostData',
	'as' => 'emp/job/post/data'
	])->middleware('auth');


Route::get('employer/applications', [
	'uses' => 'EmployerController@getApplications',
	'as' => 'emp/applications'
	])->middleware('auth');

// Applications
Route::get('/employer/applications/data', 'EmployerController@getApplicationData');
Route::get('/employer/application/response','EmployerController@ApplicationResponse');

//Dashboard
Route::get('/employer/dashboard/data','EmployerController@getDashboardData');
Route::get('/employer/startjob','EmployerController@startJob');
Route::get('/employer/endjob','EmployerController@endJob');
Route::get('/employer/endjob/summary','EmployerController@endJobSummary');
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
Route::get('/get/jobpagedata','ApplicantController@getJobPageData');
Route::get('/get/job/recommended','ApplicantController@getJobRecommended');
Route::get('/get/job/nearby','ApplicantController@getJobNearby');
Route::get('/get/job','ApplicantController@getResult');
Route::get('/app/apply','ApplicantController@Apply');

Route::get('/app/upcomingJob','ApplicantController@getUpcoming');
Route::get('/app/ongoingJob','ApplicantController@getOngoing');
Route::get('/app/activeJob','ApplicantController@getActive');
Route::get('/admin/applicant','ApplicantController@getAdmin');
Route::get('/app/dashboard/seemore','ApplicantController@getSeemore');

Route::get('/applicant/job/start',[
	'uses' => 'ApplicantController@StartJob',
	'as' => 'app/job/start'
	])->middleware('auth');

Route::get('/applicant/endjob','ApplicantController@EndJob');
Route::get('/applicant/endjob/summary','ApplicantController@endJobSummary');
Route::get('/applicant/pending/confirmation','ApplicantController@getPendingConfirmation');
Route::get('/applicant/receive/confirm','ApplicantController@receivePayment');
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