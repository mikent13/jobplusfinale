<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Jobs;
use DB;
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

     $id = Auth::user()->id;
    $databaseEvents = $this->calendarEvent->where('user_id', $id)->get();
    $calid = \Calendar::getId();

    $calendar = \Calendar::addEvents($databaseEvents);

     $emp =  DB::table('users')
            ->join('emp_calendars','users.id','=','emp_calendars.user_id')
            ->join('works','emp_calendars.user_id','=','works.user_id')
            ->join('jobs','works.user_id','=','jobs.user_id')
            ->select('jobs.title','jobs.start','jobs.end')
            ->where('users.id','=',$id)
            ->get();

         return view('employer.home',compact('calendar','calid','emp'));
  	}

  	public function getJobPost(){
  		return view('employer.jobposting');
  	}

  	public function getProfile(){
      
  		return view('users.emp-profile');
  	}

}
