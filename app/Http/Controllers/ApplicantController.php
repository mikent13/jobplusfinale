<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs;
use Auth;
use Session;
use App\FindJobs;
use App\Works;
use App\Schedules;
use App\Categories;
use App\Skills;
use App\Prof_Skill;
use App\Reviews;
use App\Paytypes;
use App\Profiles;
use App\Job_Skill;
use App\Job_Address;
use Carbon\Carbon;
use App\Work_Logs;
use DateTime;
use Illuminate\Support\Facades\Input;

class ApplicantController extends Controller
{

    private $calendarJob;

    public function __construct(Jobs $jobs){
        $this->calendarJob = $jobs;
    }


    public function getDashboard()
    {

    // $jobid    = 1;
    // $myid     = Auth::user()->id;

    // // Getting Posted Job Schedule
    // $postjob    = Jobs::where('job_id',$jobid)->first();
    // $postsched  = Schedules::where('job_id', $postjob->job_id)
    //             ->get();

    // foreach($postsched as $sches)            
    // {
      
    //   $postsched->start = Carbon::parse($postsched->start);
    //   $postsched->end = Carbon::parse($postsched->end);
    // }
    // //Getting my Schedule
    // $yourwork = Works::where('user_id', $myid)
    //             ->whereNotIn('status', [0,3])
    //             ->first();

    // if($yourwork){
    //   $mysched = Schedules::where('job_id',$yourwork->job_id)
    //              ->get();
    //   foreach($mysched as $mysch){
    //     $mysch->start = Carbon::parse($mysch->start);
    //     $mysch->end   = Carbon::parse($mysch->end);
       
    //   $result = $postsched->start->between($mysched->start,$mysched->end); 

    //     dd($result);
    //   }           

    // }

        // $userid = Auth::user()->id;
        // $profile = Profiles::where('user_id',2)->first();
        // $profid = $profile->profile_id;
       
        // $pskill = Prof_Skill::where('profile_id',$profid)->get();
        // $recskills = array();
        // foreach($pskill as $ps){
        //   $recskills[] = $ps->skill_id;
        // }

        // $recjobs = Jobs::whereIn('skill_id',$recskills)
        //                 ->get();

        // // foreach($recjobs as $rec){
        // //   $ids[] = $rec->job_id;
        // // }
        
        // $findjob = new FindJobs();
        // $skills  = Skills::all();

        // $ongoing  = $findjob->ongoingJob();
        // $active   = $findjob->activeJob();
        // $work     = $findjob->calendarJob();

        // if($active){
        // $activesched  = Schedules::where('schedule_id',$active)->first();
        // $activework   = Works::where('job_id',$activesched->job_id)->first();
        // $active       = Jobs::where('job_id',$activesched->job_id)->first();

        // $start = $activesched->start = Carbon::parse($activesched->start)->format('h:i A');
        // $end   = $activesched->end   = Carbon::parse($activesched->end)->format('h:i A');
        // }

        // $jobids  = array(); 
        //  if($work){
        //     foreach($work as $w){
        //       $jobids[] = $w->job_id;
        //     } 
        //   }

        // $databaseEvents = $this->calendarJob->whereIn('job_id',$jobids)->get();
        // $calendar       = \Calendar::addEvents($databaseEvents);

        // return view('applicant.home',compact('calendar','databaseEvents','skills','active','start','end','activework','recjobs','profile'));
      return view('applicant.dashboard');
    }

    public function getSkills(Request $req){
      $sk = $req->cat;
      if($req->cat == 0){
        $data['skills'] = Skills::all();
      }
      else{
        $data['skills'] = Skills::where('category_id',$sk)->get();
      }
      return response()->json($data);
    }

    public function getFilter(Request $req){

    }

    public function getActive(){
      $userid = Auth::user()->id;
      $jobid = array();
      $wkid = [];
      $work = Works::where('user_id', $userid)
                      ->whereNotIn('status', [1,4])
                      ->get();

      $data['work'] = $work; 

      if(!empty($work)){

        foreach($work as $wk){
          $wkid[] = $wk->job_id;
        }
        $data['wkid'] = $wkid;
        $sched = Schedules::whereIn('job_id',$wkid)->get();

          foreach($sched as $sch){

            $current   = new DateTime('now');
            $start     = new DateTime($sch->start);

            $currdate  = $current->format('Ymd');
            $startdate = $start->format('Ymd');
           
            $result    = $start->diff($current);  
          
            if($startdate === $currdate){
              $data['m1'] = 'same day and hour.';

              if($result->format('%h') == 0){
                
                $werk = Works::where('job_id',$sch->job_id)->first();
                $werk->status = 2;
                $werk->save();

                $data['status'] = 1;
                $data['sched'] = Schedules::where('schedule_id',$sch->schedule_id)->first();
                $data['active job'] =  $sch->job_id;
                $data['job'] = Jobs::where('job_id',$sch->job_id)->first();
                $data['work'] = $werk;
              } 
            }
          }
      }
      else{
        $data['status'] = 0;
        $data['message'] = 'no active job.';
      }
     
      // $sch    = Schedules::where('schedule_id',1)->first();
      // $curr   = new DateTime('now');
      // $start  = new DateTime($sch->start);
      
      // // //Getting the active job
      // $currtime  = $curr->format('Ymdhi');
      // $starttime = $start->format('Ymdhi'); 
      // if($starttime <= $currtime){
      //   $data['lessthan'] = 'true';
      // }
      // //    //Start job with 30 mins allowance
      // $result = $start->diff($curr);
      // // }

      // if($result->format('%i') >= 30){
      //   $data['message'] = 'You have been late by 30 min.';
      // }
      // elseif($result->format('%i') >= 0 &&  $result->format('%i') < 30)
      // {
      //           $data['message'] = "You're on time.";
      // }
        //   $data['curtime'] = $currtime;
      //   $data['startime'] = $starttime;
      // }


      // else
      // {
      //   $data['min'] = 'false';
      // }

      // $data['current'] = date_format($curr,'Y-m-d h:i:s');
      // $data['start'] = date_format($start,'Y-m-d h:i:s');
      // $data['curformat'] = $curr->format('Ymdhi');
      // $data['startformat'] = $start->format('Ymdhi');
      // $data['result'] = $result;

      return response()->json($data);
    }

    public function getUpcoming(){
      $userid = Auth::user()->id;

      return response()->json($data);
    }

    public function getOngoing(){
      $userid = Auth::user()->id;
      $jobid = array();

      $works = Works::where('user_id', $userid)
                      ->where('is_start', 0)
                      ->where('status', 3)
                      ->get();

      if(count($works) > 0){
        foreach($works as $work){
          $jobid[] = $work->job_id;
        }

        $jobs = Jobs::whereIn('job_id',$jobid)->get();
        $data['job'] = $jobs;
        $data['status'] = 1;
      } 
      else{
        $data['status'] = 0;
      }

      return response()->json($data);
    }

    public function getNotification($id){
    
    }

    public function getJobSearch(Request $req){
      $loc      = $req->location;
      $cat      = $req->cat;
      $skill    = $req->skill;
      $salary   = $req->salary;
      $paytype  = $req->ptype;
      $firstids = array();
      $addids = [];
      $profile = Profiles::all();
      $jobadd = Job_Address::all();

      $data['jobadd'] = $jobadd;
      $data['profile'] = $profile;
      
      if( $cat != 0 && $skill != null ){
        $newsk = Skills::where('name','like', '%'.$skill.'%')->first();
        $firsts = Jobs::where('category_id',$cat)->where('skill_id',$newsk->skill_id)->get()->sortBy('date_posted');
      }
      elseif( $cat != 0 && $skill == null ){
        $firsts = Jobs::where('category_id',$cat)->get();
      }
      elseif( $cat == 0 && $skill != null ){
        $newsk = Skills::where('name','like', '%'.$skill.'%')->first();
        $firsts = Jobs::where('skill_id',$newsk->skill_id)->get()->sortBy('date_posted');
      }
      elseif( $cat == 0 && $skill == null ){
        $firsts = Jobs::all()->sortBy('date_posted');
      }

      foreach($firsts as $first){
        $firstids[] = $first->job_id;
      }

      $address = Job_Address::whereIn('jobid',$firstids)->get();
      foreach($address as $add){
        if($add->locality == $loc){
          $addids[] = $add->jobid;
        }
      }

      $first = Jobs::whereIn('job_id',$addids)->get();

      if($paytype == 0 && $salary == 0){
        $data['jobs'] = $first;
        $data['message'] = $firstids;
        $data['add'] = $loc;
        return response()->json($data);
      }
      
      // Filters
        if( $paytype == 0 && $salary != 0 ){
          if($salary == 1){     
            $seconds = Jobs::whereIn('job_id',$firstids)
                            ->where('salary', '<=' , 500)->get();
          }
          elseif($salary == 2){
            $seconds = Jobs::whereIn('job_id',$firstids)
                            ->where('salary', '<=' , 1000)->get(); 
          }
          elseif($salary == 3){
            $seconds = Jobs::whereIn('job_id',$firstids)
                            ->where('salary', '>=' , 1000)->get();
          }
        }
        elseif( $paytype != 0 && $salary == 0 ){
            $seconds = Jobs::whereIn('job_id',$firstids)
                            ->where('paytype', $paytype)->get();
        }
        elseif( $paytype != 0 && $salary != 0 ){
          if($salary == 1){
            $seconds = Jobs::whereIn('job_id', $firstids)
                          ->where('paytype', $paytype)
                          ->where('salary', '<=' , 500)->get();
          }
          elseif($salary == 2){
            $seconds = Jobs::whereIn('job_id', $firstids)
                          ->where('paytype', $paytype)
                          ->where('salary', '<=' , 1000)->get(); 
          }
          elseif($salary == 3){
            $seconds = Jobs::whereIn('job_id', $firstids)
                          ->where('paytype', $paytype)
                          ->where('salary', '>' , 1000)->get(); 
          }
        }

      $data['jobs'] = $seconds;
      $data['message'] = 'second';
      return response()->json($data);

    }

    public function getResult(Request $request){

      $job              = Jobs::where('job_id',$request->jobid)->first();
      $category         = Categories::where('category_id',$job->category_id)->first();
      $sched            = Schedules::where('job_id',$job->job_id)->get();
      $postedby         = Profiles::where('user_id', $job->user_id)->first();
      $jskill           = Job_Skill::where('job_id', $job->job_id)->get();
      $address          = Job_Address::where('jobid',$job->job_id)->first();
      $sk = array();

      foreach($jskill as $jk){
        $sk[] = $jk->skill_id;
      }

      $skill            = Skills::whereIn('skill_id',$sk)->get(); 
      $paytype          = Paytypes::where('paytype_id',$job->paytype)->first();

      $data['address']  = $address;
      $data['paytype']  = $paytype;
      $data['skill']    = $skill;
      $data['user']     = $postedby;
      $data['sched']    = $sched;
      $data['job']      = $job; 
      $data['category'] = $category;

      return response()->json($data);
    }

    public function getJobRecommended(){
      $id = Auth::user()->id;
      $outputprofile = Profiles::all();
      $jobs = Jobs::all();

      $profile  = Profiles::where('user_id',$id)->first();
      $skill    = Prof_Skill::where('profile_id',$profile->profile_id)->get();
      $jobadd   = Job_Address::where('locality',$profile->locality)->get();

      foreach($skill as $sk){
        $skids[] = $sk->skill_id;
      }
     
      $jobskills = Job_Skill::whereIn('skill_id',$skids)
                              ->get();

      $data['jobs'] = $jobs;
      $data['jobskills'] = $jobskills;
      $data['jobadd'] = $jobadd;
      $data['profile'] = $outputprofile;
      $data['message'] = 'success';

      return response()->json($data);
      
    }

    public function getJobPage(){
        return view('applicant.jobfeeds');
    }

    public function getJobPageData(){
       $jobs = Jobs::all();
       $jobskills = Job_Skill::all();
       $jobadd = Job_Address::all();
       $profile = Profiles::all();

       $data['jobs']           = $jobs;
       $data['jobskill'] = $jobskills;
       $data['jobadd'] = $jobadd;    
       $data['profile'] = $profile;

       $data['skill']          = Skills::all();
       $data['paytypes']       = Paytypes::all();
       $data['categories']     = Categories::all();
       return response()->json($data);
    }

    public function getProfile(){
      return view('users.app-profile');
    }

    public function Apply(Request $req){
      $work           = new Works;
      $work->job_id   = $req->jobid;
      $work->user_id  = Auth::user()->id;
      $work->status   = 0;
      $work->date     = Carbon::now();
      $work->save();

      $data['success'] = 'Application sent!';
      $data['id']      = $req->jobid;

      return response()->json($data);
    }

   public function StartJob(Request $req){
    $workid = $req->workid;
    $schedid = $req->schedid;

    $sched = Schedules::where('schedule_id',$schedid)->first();
    $work = Works::where('work_id',$workid)->first();
    $work->is_start = 1;
    $work->save();

    $current   = new DateTime('now');
    $start     = new DateTime($sched->start);
    $end        = new DateTime($sched->end);

    $result    = $start->diff($current);  
    $min       = $result->format('%i');

    if($min >= 30){
      //late
      $data['late'] = 1;
    }

    $data['message'] = 'success';
    return response()->json($data);  
  }

  public function EndJob(Request $req){

    $rate   = $req->rating;
    $desc   = $req->review;
    $workid  = $req->workid;
    $employer = $req->reviewed;
    $reviewer = Auth::user()->id;

    $review               = new Reviews;
    $review->comment      = $desc;
    $review->reviewed_id  = $employer; 
    $review->rating       = $rate;
    $review->reviewer_id  = $reviewer;
    $review->work_id      = $workid;
    $review->save();

    $werk = Works::where('work_id',$workid)->first();
    $werk->status = 4;
    $werk->is_start = 0;
    $werk->save();

    $werk_log = new Work_Logs;
    $werk_log->work_id = $workid;
    $werk_log->date_ended = new DateTime('now');
    $werk_log->save();

    $data['status'] = 1;

    return response()->json($data);
  }

  public function viewJob($id){
    $profile = Profiles::all();
    $skills  = Skills::all();
    $job = Jobs::where('job_id',$id)->first();
    return view('applicant.jobinfo',compact('job','skills','profile'));
  }

}
