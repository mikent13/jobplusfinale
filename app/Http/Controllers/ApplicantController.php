<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Work;
use App\Http\Requests;
use App\Jobs;
use App\User;
use App\Profiles;
use Carbon\Carbon;

class ApplicantController extends Controller
{

      private $calendarEvent;

    public function __construct(Jobs $jobs)
    {
        $this->calendarEvent = $jobs;
    }

    public function index(){

        $databaseEvents = $this->calendarEvent->all();
        $calid = \Calendar::getId();

        $calendar = \Calendar::addEvents($databaseEvents);
    	return view('applicant.home',compact('calendar','calid'));
    }

    public function getApply($jobid,$id){
    	$user = $id;
    	return view('applicant.home');
    }

    public function getProfile(){
    	return view('layouts.profile');
    }

    public function getJobSearch($jobid){
        $job = Job::findorFail($jobid);
        return view('applicant.jobsearch',compact('job'));
    }

    public function getJobPage(){
    	return view('applicant.jobpage');
    }

    public function degree(){
        return Education::with('degrees')->get();
    }
    public function test($id){
        $profile = Profiles::with('degrees')->get();   
        return view('applicant.test',compact('profile'));
    }

}
