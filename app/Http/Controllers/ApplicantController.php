<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Work;
use App\Http\Requests;
use App\Jobs;
use App\User;
use App\Profiles;
use Carbon\Carbon;
use DB;

class ApplicantController extends Controller
{

    private $calendarEvent;

    public function __construct(Jobs $jobs){
        $this->calendarEvent = $jobs;
    }

    public function index(){
 
    }

    public function getDashboard(Request $request)
    {
    
    $databaseEvents = $this->calendarEvent->all();
    $calid = \Calendar::getId();

    $calendar = \Calendar::addEvents($databaseEvents);

     $id = $request['id'];
     $app =  DB::table('users')
            ->join('app_calendars','users.id','=','app_calendars.user_id')
            ->join('works','app_calendars.user_id','=','works.user_id')
            ->join('jobs','works.user_id','=','jobs.user_id')
            ->leftjoin('schedules','jobs.id','=','schedules.job_id')
            ->select('jobs.title','jobs.start_date','jobs.end_date')
            ->where('users.id','=',$request['id'])
            ->get();

         return view('applicant.home',compact('calendar','calid'));
    }

    public function getNotification($id){
     $noti = DB::table('users')
        ->join('app_notifications','users.id','=','app_notifications.user_id')
        ->select('app_notifications.description')
        ->where('users.id','=',$id)
        ->get();

    }

    public function Apply(Request $request){
    	
        //Ajax Apply Request
    	
    }

    public function getJobSearch(){

        //Filters and search

         return view('applicant.jobsearch');
    }

    public function getJobPage(Request $request){

        return view('applicant.jobpage');
    }

}
