<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Jobs;
use App\Works;
use App\Profiles;
use App\Schedules;
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

       

        $profiles = Profiles::all();
         return view('employer.home',compact('applications','profiles','jobs'));
  	}

  	public function getJobPost(){
  		return view('employer.jobposting');
  	}

  	public function getProfile(){
      
  		return view('users.emp-profile');
  	}

    public function getApplications(){
      
      $myid = Auth::user()->id;
      $jobs = Jobs::where('user_id',$myid)->get();
      $jobids = [];
      foreach($jobs as $j){
        $jobids[] = $j->job_id;
      }

      $sched = Schedules::whereIn('job_id',$jobids)->get();

      $work = Works::where('status',5)->get();

      $profiles = Profiles::all();
                    
      return view('employer.application',compact('profiles','jobs','work','sched'));
    }

    public function ApplicationResponse(Request $req){
      $id = $req->workid;
      $work           = Works::where('work_id',$id)->first();
      $work->status   = 3;
      $work->save();

      $data['success'] = $work->work_id + 'accepted!';

      return response()->json($data);

    }
}
