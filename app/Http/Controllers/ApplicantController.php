<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Work;
use App\Http\Requests;
use App\Jobs;
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

    public function getJobSearch(){
        return view('applicant.jobsearch');
    }

    public function getJob(){
    	return view('applicant.jobpage');
    }
}
