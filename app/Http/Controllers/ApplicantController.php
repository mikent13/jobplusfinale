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

  public function getAdmin(){
    return view('masters.appPrimary');
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
    $wkid = [];

    $active = Works::where('status',1)
    ->where('applicant_id',$userid)
    ->first();

    if(!empty($active)){

      $data['active'] = 1;
      $sched = Schedules::where('schedule_id',$active->sched_id)->first();
      $job = Jobs::where('job_id',$sched->job_id)->first();
      $address = Job_Address::where('jobid',$job->job_id)->first();
      $employer = Profiles::where('user_id',$job->user_id)->first();

      $data['sched'] = $sched;
      $data['job'] = $job;
      $data['work'] = $active;
      $data['address'] = $address;
      $data['employer'] = $employer;

    }  
    else{

      $data['active'] = 0;

      $upwork = Works::where('applicant_id', $userid)
      ->where('status',2)
      ->get();

      if(!empty($upwork)){
        $data['status'] = 1;
        $schedid = [];

        foreach($upwork as $upw){
          $schedid[] = $upw->sched_id;
        }

        $sched = Schedules::orderBy('start','ASC')
        ->whereIn('schedule_id',$schedid)
        ->first();

        $now = new DateTime;
        $start = new DateTime($sched->start);

        $data['start'] = $start;

        $result = $now->diff($start);
        $rhour = $result->format('%h');
        if($rhour == 0){
            // $data['min'] = '30 min';
          $work = Works::where('sched_id',$sched->schedule_id)->first();
          $work->status = 1;
          $work->save();

          $sched = Schedules::where('schedule_id',$work->sched_id)->first();
          $job = Jobs::where('job_id',$sched->job_id)->first();
          $address = Job_Address::where('jobid',$job->job_id)->first();
          $employer = Profiles::where('user_id',$job->user_id)->first();

          $data['sched'] = $sched;
          $data['job'] = $job;
          $data['work'] = $work;
          $data['address'] = $address;
          $data['employer'] = $employer;
        }


      // $work = Works::where('sched_id',$sched->schedule_id)
      //               ->first();
        $data['result'] = $result;

      }
      else{
        $data['status'] = 0;
      }
    }

    return response()->json($data);
  }

  public function getUpcoming(){
    $userid = Auth::user()->id;

    $work = Works::where('applicant_id',$userid)
    ->where('status',3)
    ->get();

    if(count($work) > 0){
      $data['ongoing'] = 'success';
      $schedid = [];
      foreach($work as $w){
        $schedid[] = $w->sched_id;
      }

      //--------------Converting Ongoing Jobs to Upcoming --------------//

      $now = new DateTime;
      $sched = Schedules::whereIn('schedule_id',$schedid)->get();

      $startid = [];
      foreach($sched as $sch){
        $starts = new DateTime($sch->start);
        $ends = new DateTime($sch->end);
        if($starts > $now){
          $startid[] = $sch->schedule_id;
        }
      }
      $work = Works::whereIn('sched_id',$startid)->get();
      foreach($work as $w){
        $w->status = 2;
        $w->save();
      }
    }
    else{
     $data['ongoing'] = 'none';
   }

  //-------------- Getting the Upcoming Jobs --------------//

   $upcoming = Works::where('status',2)
   ->where('applicant_id',$userid)
   ->get();

   if(count($upcoming) > 0){
    $data['status'] = 1;

    $upschedid  = [];
    foreach($upcoming as $up){
      $upschedid[] = $up->sched_id;
    }

    $upsched = Schedules::orderBy('start','ASC')
    ->whereIn('schedule_id',$upschedid)
    ->get();

    $jobid = [];
    foreach($upsched as $upsch){
      $jobid[] = $upsch->job_id;
    }

    $job = Jobs::whereIn('job_id',$jobid)->get();

    $userid = [];
    foreach($job as $j){
      $userid[] = $j->user_id;
    }
    $profile = Profiles::whereIn('user_id',$userid)->get();

    $data['work'] = $upcoming;
    $data['profile'] = $profile;
    $data['job'] = $job;
    $data['sched'] = $upsched;
  }
  else{
    $data['status'] = 0;
  }

  return response()->json($data);
}

public function getOngoing(){
  $userid = Auth::user()->id;
  $jobid = [];

  $works = Works::where('user_id', $userid)
  ->where('status', 4)
  ->get();

  if(count($works) > 0){
    foreach($works as $work){
      $jobid[] = $work->job_id;
    }
    $job = Jobs::whereIn('job_id',$jobid)->get();
    $data['workids'] = $jobid;
    $data['status'] = 1;
  } 
  else{
    $data['status'] = 0;
  }

  $data['response'] = 'okay';
  return response()->json($data);
}

public function getNotification(){

}

public function getJobNearby(Request $req){
  $loc = $req->loc;
  $id = Auth::user()->id;
  $outputprofile = Profiles::all();
  $jobs = Jobs::all();

  $profile  = Profiles::where('user_id',$id)->first(); 
  $skill    = Prof_Skill::where('profile_id',$profile->profile_id)->get();

  foreach($skill as $sk){
    $skids[] = $sk->skill_id;
  }

  $jobskills = Job_Skill::whereIn('skill_id',$skids)
  ->get();
  $jskid = [];

  foreach($jobskills as $jsk){
    $jskid[] = $jsk->job_id;
  } 

  $jobadd   = Job_Address::where('locality',$loc)
  ->whereIn('jobid',$jskid)->get();

  $jaddids =[];
  foreach($jobadd as $jadd){
    $jaddids[] = $jadd->jobid;
  }

  $jobs = Jobs::WhereIn('job_id',$jaddids)->get();

  $data['jobs'] = $jobs;
  $data['jobskills'] = $jobskills;
  $data['add'] = $jobadd;
  $data['profile'] = $outputprofile;
  $data['message'] = 'success';

  return response()->json($data);    
}

public function getSeemore(Request $req){

  $workid = $req->workid;
  $schedid = $req->schedid;
  $data['status'] = 1;

  $work = Works::where('work_id',$workid)->first();
  $sched = Schedules::where('schedule_id',$work->sched_id)->first();
  $job = Jobs::where('job_id',$sched->job_id)->first();
  $profile = Profiles::where('user_id',$job->user_id)->first();
  $address = Job_Address::where('jobid',$job->job_id)->first();

  $data['address'] = $address;
  $data['profile'] = $profile;
  $data['work'] = $work;
  $data['job'] = $job;
  $data['sched'] = $sched;
  return response()->json($data); 
}

public function getJobSearch(Request $req){

  $skill = [];

  $loc      = $req->location;
  $cat      = $req->cat;
  $skill    = $req->skill;
  $salary   = $req->salary;
  $paytype  = $req->ptype;
  $firstids = [];
  $addids = [];
  $newskid = [];
  $jskid = [];
  $profid = [];
  $jobaddid =[];
  $profile = Profiles::all();
  $jobadd = Job_Address::all();

  $data['loc'] = $loc;

  if(  $skill != null ){
    $newsk = Skills::whereIn('skill_id',$skill)->get();

    foreach($newsk as $newerskill){
      $newskid[] = $newerskill->skill_id;
    }

    $jskill = Job_Skill::whereIn('skill_id',$newskid)->get();

    foreach($jskill as $newerjskill){
      $jskid[] = $newerjskill->job_id;
    }

    $data['jobskill'] = $jskid;

    $firsts = Jobs::whereIn('job_id',$jskid)->get();
  }

  elseif( $cat != 0 && $skill == null ){
    $firsts = Jobs::where('category_id',$cat)->get();
  }

  elseif( $cat == 0 && $skill == null ){
    $firsts = all();
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

      //Getting the profiles
  foreach($first as $f){
    $profid[] = $f->user_id;
    $jobaddid[] = $f->job_id;
  }
  $newprof = Profiles::whereIn('user_id',$profid)->get();
  $data['profile'] = $newprof;

      //Getting the Address
  $jobadd = Job_Address::whereIn('jobid',$jobaddid)->get();
  $data['add'] = $jobadd;

  if($paytype == 0 && $salary == 0){
    $data['jobs'] = $first;
    $data['message'] = $firstids;
    return response()->json($data);
  }

      // Filters
  if( $paytype == 0 && $salary != 0 ){
    if($salary == 1){     
      $seconds = Jobs::whereIn('job_id',$jobaddid)
      ->where('salary', '<=' , 500)->get();
    }
    elseif($salary == 2){
      $seconds = Jobs::whereIn('job_id',$jobaddid)
      ->where('salary', '<=' , 1000)->get(); 
    }
    elseif($salary == 3){
      $seconds = Jobs::whereIn('job_id',$jobaddid)
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

  foreach($skill as $sk){
    $skids[] = $sk->skill_id;
  }

  $jobskills = Job_Skill::whereIn('skill_id',$skids)
  ->get();
  $jskid = [];

  foreach($jobskills as $jsk){
    $jskid[] = $jsk->job_id;
  } 

  $jobadd   = Job_Address::where('locality',$profile->locality)
  ->whereIn('jobid',$jskid)->get();

  $jaddids =[];
  foreach($jobadd as $jadd){
    $jaddids[] = $jadd->jobid;
  }

  $jobs = Jobs::WhereIn('job_id',$jaddids)->get();

  $data['jobs'] = $jobs;
  $data['jobskills'] = $jobskills;
  $data['add'] = $jobadd;
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

  $work = Works::where('work_id',$workid)->first();

  if($work->is_start == 1){
    $data['status'] = 0;
  }
  else{
   $sched = Schedules::where('schedule_id',$work->sched_id)->first();
   $now = new DateTime;
   $start = new DateTime($sched->start);
   $start->modify('+30 minutes');
   $difference = $start->diff($now);
   $data['start'] = $start;
   $data['diff'] = $difference;

   if($difference->invert == 0){
    $data['late'] = 1;
   }
   else{
    $data['late'] = 0;
   }
   
  $work->is_start = 1;
  $work->save();
  $data['status'] = 1;
}
    // $sched = Schedules::where('schedule_id',$schedid)->first();
    // $current   = new DateTime('now');
    // $start     = new DateTime($sched->start);
    // $end        = new DateTime($sched->end);

    // $result    = $start->diff($current);  
    // $min       = $result->format('%i');

    // if($min >= 30){
    //   //late
    //   $data['late'] = 1;
    // }

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
