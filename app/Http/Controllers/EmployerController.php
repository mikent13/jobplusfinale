<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Jobs;
use App\Works;
use App\Profiles;
use Auth;

class EmployerController extends Controller
{
     public function index(){
     	$jobs = Job::all();
    	return view('employer.home',compact('jobs'));
    }

    private $calendarEvent;

    public function __construct(Jobs $jobs){
        $this->calendarEvent = $jobs;
    }

  	public function getDashboard(){
        $userid = Auth::user()->id;
        $jobs = Jobs::where('user_id',$userid)->get();
        $jobb = array();
        
        foreach($jobs as $job){
          $jobb[] = $job->job_id;
        };

        $applications = Works::whereIn('job_id',$jobb)
                              ->where('status',0)
                              ->get();

        $profiles = Profiles::all();
         return view('employer.home',compact('applications','profiles'));
  	}

  	public function getJobPost(){
  		return view('employer.jobposting');
  	}

  	public function getProfile(){
      
  		return view('users.emp-profile');
  	}

}
