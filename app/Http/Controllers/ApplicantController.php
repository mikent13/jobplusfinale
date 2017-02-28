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
use App\Work_Reviewed;
use Carbon\Carbon;
use App\Application;
use App\Work_Logs;
use App\Work_Summary;
use DateTime;
use App\JobRank;
use Illuminate\Support\Facades\Input;

class ApplicantController extends Controller
{

  private $calendarJob;

  public function __construct(Jobs $jobs){
    $this->calendarJob = $jobs;
  }

  public function getrank(){
    $rank = new JobRank();
    return response()->json($rank);
  }

  public function getAdmin(){
    return view('masters.appPrimary');
  }

  public function getDashboard()
  {
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


  function getPrevJobLocation(){
    $today = new DateTime();
    $today = $today->format('ymd');
    $job = new DateTime('2017-02-28');
    $job = $job->format('ymd');
    // dd(($today == $job));
    $id = Auth::user()->id;
    $workschedID = [];
    $work = Works::where('applicant_id',$id)->where('status',4)->get();
    if(count($work)>0){
      foreach($work as $wk){
        $wkend = new DateTime($wk->end_time);
        $wkend = $wkend->format('ymd');
        if(($today == $wkend) == true){
          $workschedID[] = $wk->sched_id;
        }
      }
      $sched = Schedules::orderBy('start','DESC')->whereIn('schedule_id',$workschedID)->first();
      $finalwork = Works::where('sched_id',$sched->schedule_id)->first();
      return $finalwork;
    }
    else{
      return null;
    }
  }

  public function getActive(){
   $userid = Auth::user()->id;
   $prof = Profiles::where('user_id',$userid)->first();
   $response = [];
   $origin = [];
   $prevwork = $this->getPrevJobLocation();

   if($prevwork!=null){
    $lat = $prevwork->schedules->jobs->address->lat;
    $lng = $prevwork->schedules->jobs->address->lng;
    $origin =['lat' => $lat,'lng' => $lng];
    $data['previous_status'] = 200;
  }
  else{
    $data['previous_status'] = 400;
  }

  $data['origin'] = $origin;


  $active = Works::where('status',1)->where('applicant_id',$userid)->first();

  if(!empty($active)){
   $data['active'] = 1;
   $response[]= [
   'work' => $active,
   'job' => $active->schedules->jobs,
   'paytype' => $active->schedules->jobs->paytypes->name,
   'schedule' => $active->schedules,
   'destination' => $active->schedules->jobs->address,
   'employer' =>$active->schedules->jobs->users->profile,
   'profile' => $prof
   ];

 }  
 else{

  $data['active'] = 0;

  $upwork = Works::where('applicant_id', $userid)->where('status',2)->get();

  if(count($upwork) > 0){
    $data['status'] = 1;
    $schedid = [];

    foreach($upwork as $upw){
      $schedid[] = $upw->sched_id;
    }

    $sched = Schedules::orderBy('start','ASC')->whereIn('schedule_id',$schedid)->first();
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
      $response[]= [
      'work' => $work,
      'job' => $work->schedules->jobs,
      'schedule' => $work->schedules,
      'destination' => $work->schedules->jobs->address,
      'employer' =>$work->schedules->jobs->users->profile,
      'mine' => $prof
      ];
    }
    $data['result'] = $result;

  }
  else{
    $data['status'] = 0;
  }
}

$lat = 14.5512;
$lng = 121.023;
$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false';
$json = @file_get_contents($url);
$datas = json_decode($json);
$data['gmap'] = $datas;

$disturl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=Washington,DC&destinations=New+York+City,NY&key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places
';
$distjson = @file_get_contents($disturl);
$distdata = json_decode($distjson);
$data['distance'] = $distdata;
$data['response'] = $response;
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

  $userid = Auth::user()->id;
  $profile = Profiles::where('user_id',$userid)->first();
  $address = Job_Address::where('locality','Cebu City')->get();
  $userskills = Prof_Skill::where('profile_id',$profile->profile_id)->get();
  $userskill = [];

  if(count($userskills) > 0){
    foreach($userskills as $usk){
      $userskill[] = $usk->skill_id; 
    }
  }

  $lat1 = (float)10.309768188276134;
  $long1 = (float) 123.892872;

  $ranker = new JobRank;
  $criteria_Loc = 0.5;
  $criteria_skill = 0.3;
  $criteria_history = 0.2;
  $location_arr = [];
  $loc_points = [];
  $skill_points = [];
  $history_arr = [];
  $history_points = [];
  $addressID = [];  

  foreach($address as $add){
    $addressID[] = $add->jobid;
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$add->lat.",".$add->lng."&mode=transit&key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places";
    $json = @file_get_contents($url);
    $location_datas = json_decode($json);
    // $location_arr = $ranker->array_push_assoc($location_arr, $add->jobid,$location_datas->rows[0]->elements[0]->distance->value);
    $loc_points = $ranker->array_push_assoc($loc_points, $add->jobid,$ranker->getLocationPoints($location_datas->rows[0]->elements[0]->distance->value) * $criteria_Loc);
    $skill_points = $ranker->array_push_assoc($skill_points,$add->jobid,$ranker->getSkillPoints($userskill,$add->jobid) * $criteria_skill);
    $history_points = $ranker->array_push_assoc($history_points,$add->jobid,$ranker->getHistory($add->jobid,$userid) * $criteria_history);
  }

  $addCount = count($addressID);
  $result = [];
  for($i = 0; $i< $addCount; $i++){
    $result[$addressID[$i]] = ( $loc_points[$addressID[$i]] + $skill_points[$addressID[$i]] + $history_points[$addressID[$i]] ) / 3;
  }

  function cmps($a, $b)
  {
    if ($a == $b) {
      return 0;
    }
    return ($a > $b) ? -1 : 1;
  }

  uasort($result,"App\Http\Controllers\cmps");
  $finalres = [];

  foreach($result as $key => $res){
    $finalres[] = $key;
  }

  $finaljobs = Jobs::whereIn('job_id',$finalres)->get();
  $jobsss = Jobs::all();

  $data['jobs']   = $finaljobs;   
  $data['final'] = $finalres;
  $data['result'] = $result;
  $data['location_arr'] = $location_arr;
  $data['loc_points'] = $loc_points;
  $data['skill_points'] = $skill_points;
  $data['history_points'] = $history_points;
  $data['profile'] = Profiles::all();
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
  $job_skill        = Job_Skill::where('job_id',$job->job_id)->get();
  $skillID = [];
  $sched = Schedules::where('job_id',$job->job_id)->get();
  foreach($job_skill as $js){
    $skillID[] = $js->skill_id;
  }

  $skill = Skills::whereIn('skill_id',$skillID)->get();

  $response[] =[
  'job' => $job,
  'paytype' => $job->paytypes->name,
  'jobtype' => $job->jobtypes->name,
  'skill' => $skill,
  'user' => $job->users->profile,
  'schedule' => $sched,
  'category' => $job->categories->name,
  'address' => $job->address
  ];
  $data['response'] = $response;

  return response()->json($data);
}

public function getJobRecommended(){
 $userid = Auth::user()->id;
 $profile = Profiles::where('user_id',$userid)->first();
 $address = Job_Address::where('locality','Cebu City')->get();
 $userskills = Prof_Skill::where('profile_id',$profile->profile_id)->get();
 $userskill = [];

 if(count($userskills) > 0){
  foreach($userskills as $usk){
    $userskill[] = $usk->skill_id; 
  }
}

$lat1 = (float)10.309768188276134;
$long1 = (float) 123.892872;

$ranker = new JobRank;
$criteria_Loc = 0.3;
$criteria_skill = 0.5;
$criteria_history = 0.2;
$location_arr = [];
$loc_points = [];
$skill_points = [];
$history_arr = [];
$history_points = [];
$addressID = [];  
foreach($address as $add){
  $addressID[] = $add->jobid;
  $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$add->lat.",".$add->lng."&mode=transit&key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places";
  $json = @file_get_contents($url);
  $location_datas = json_decode($json);
  $location_arr = $ranker->array_push_assoc($location_arr, $add->jobid,$location_datas->rows[0]->elements[0]->distance->value);
  $loc_points = $ranker->array_push_assoc($loc_points, $add->jobid,$ranker->getLocationPoints($location_datas->rows[0]->elements[0]->distance->value) * $criteria_Loc);
  $skill_points = $ranker->array_push_assoc($skill_points,$add->jobid,$ranker->getSkillPoints($userskill,$add->jobid) * $criteria_skill);
  $history_points = $ranker->array_push_assoc($history_points,$add->jobid,$ranker->getHistory($add->jobid,$userid) * $criteria_history);
}

$addCount = count($addressID);
$result = [];
for($i = 0; $i< $addCount; $i++){
  $result[$addressID[$i]] = ( $loc_points[$addressID[$i]] + $skill_points[$addressID[$i]] + $history_points[$addressID[$i]] ) / 3;
}

function cmps($a, $b)
{
  if ($a == $b) {
    return 0;
  }
  return ($a > $b) ? -1 : 1;
}

uasort($result,"App\Http\Controllers\cmps");
$finalres = [];

foreach($result as $key => $res){
  $finalres[] = $key;
}

$finaljobs = Jobs::whereIn('job_id',$finalres)->get();

$data['jobs']   = $finaljobs;   
$data['final'] = $finalres;
$data['result'] = $result;
$data['location_arr'] = $location_arr;
$data['loc_points'] = $loc_points;
$data['skill_points'] = $skill_points;
$data['history_points'] = $history_points;
$data['profile'] = Profiles::all();
$data['message'] = 'success';
return response()->json($data);

}

public function getJobPage(){
  return view('applicant.jobfeeds');
}

public function getJobPageData(){
//  $userid = Auth::user()->id;
//  $lat1 = (float)10.309768188276134;
//  $long1 = (float) 123.892872;
//  $criteria_Loc = 0.2;
//  $criteria_skill = 0.3;
//  $criteria_history = 0.5;
//  $location_arr = [];
//  $loc_points = [];
//  $skill_points = [];
//  $history_arr = [];
//  $history_points = [];
//  $addressID = []; 
//  $jobids = [];
//  $userskill = [];
//  $result = [];
//  $finalres = [];
// $schedID = [];
// $schJobID = [];

//  $ranker = new JobRank;
//  $work = Works::where('applicant_id',$userid)
//                 ->whereNotIn('status',[4,5])->get();

//   $address = Job_Address::where('locality','Cebu City')->get();
//  if(count($work) > 0){
//   foreach($work as $w){
//     $schedID[] = $w->sched_id;
//   }
//   $scheds = Schedules::whereIn('schedule_id',$schedID)->get();
//   foreach($scheds as $sch){
//     $schJobID[] = $sch->job_id;
//   }
//  $address = Job_Address::where('locality','Cebu City')
//                         ->whereNotIn('jobid',$schJobID)->get();
//  }

//  $jobids = $ranker->removeConflict($userid,$address);

//  if($jobids){
//  $address = Job_Address::whereIn('jobid',$jobids)->get();

// }
// $profile = Profiles::where('user_id',$userid)->first();
// $userskills = Prof_Skill::where('profile_id',$profile->profile_id)->get();

// if(count($userskills) > 0){
//   foreach($userskills as $usk){
//     $userskill[] = $usk->skill_id; 
//   }
// }

// foreach($address as $add){
//   $addressID[] = $add->jobid;
//   $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$add->lat.",".$add->lng."&mode=transit&key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places";
//   $json = @file_get_contents($url);
//   $location_datas = json_decode($json);
//   $location_arr = $ranker->array_push_assoc($location_arr, $add->jobid,$location_datas->rows[0]->elements[0]->distance->value);
//   $loc_points = $ranker->array_push_assoc($loc_points, $add->jobid,$ranker->getLocationPoints($location_datas->rows[0]->elements[0]->distance->value) * $criteria_Loc);
//   $skill_points = $ranker->array_push_assoc($skill_points,$add->jobid,$ranker->getSkillPoints($userskill,$add->jobid) * $criteria_skill);
//   $history_points = $ranker->array_push_assoc($history_points,$add->jobid,$ranker->getHistory($add->jobid,$userid) * $criteria_history);
// }

// for($i = 0; $i< count($addressID); $i++){
//   $result[$addressID[$i]] = ( $loc_points[$addressID[$i]] + $skill_points[$addressID[$i]] + $history_points[$addressID[$i]] ) / 3;
// }

// function cmps($a, $b)
// {
//   if ($a == $b) {
//     return 0;
//   }
//   return ($a > $b) ? -1 : 1;
// }

// uasort($result,"App\Http\Controllers\cmps");

// foreach($result as $key => $res){
//   $finalres[] = $key;
// }

// $finaljobs = Jobs::whereIn('job_id',$finalres)->get();

// $data['jobs']   = $finaljobs;   
// $data['final'] = $finalres;
// $data['result'] = $result;
// $data['location_arr'] = $location_arr;
// $data['loc_points'] = $loc_points;
// $data['skill_points'] = $skill_points;
// $data['history_points'] = $history_points;
  $data['jobs'] = Jobs::all();
  $data['profile'] = Profiles::all();
  $data['message'] = 'success';

  $data['skill']          = Skills::all();
  $data['paytypes']       = Paytypes::all();
  $data['categories']     = Categories::all();

  return response()->json($data);
}

public function getProfile(){
  return view('users.app-profile');
}

public function Apply(Request $req){
  $jobid = $req->jobid;
  $today = new DateTime;
  $userid = Auth::user()->id;

  $application = new Application;
  $application->applicant = $userid;
  $application->job = $jobid;
  $application->date = $today;
  $application->is_accepted = 0;
  $application->save();

  $data['status'] = 1; 

  return response()->json($data);
}

public function getPendingConfirmation(){
  $id = Auth::user()->id;
  $sum = Work_Summary::all();
  if(count($sum) >0){
    foreach($sum as $s){
      if($s->works->applicant_id == $id){
        $work_sum = Work_Summary::where('summary_id',$s->summary_id)->first();
      }
    }
    $response = [];
    $response = [
    'summary' => $work_sum,
    'employer' => $work_sum->works->schedules->jobs->users->profile ,
    'work' => $work_sum->works
    ];
    $data['summary'] = $response;
    $status = 200;
  }
  else{
    $status = 400;
  }

  $data['status'] = $status;
    return response()->json($data);
}

public function endJobSummary(Request $req){
  $workid = $req->workid;
  $work = Works::where('work_id',$workid)->first();
  $work->end_time = new DateTime;
  $work->save();

  $newwork = Works::where('work_id',$work->work_id)->first();
  $summary = [];

  $started = new DateTime($newwork->start_time);
  $ended = new DateTime($newwork->end_time);
  $result = $ended->diff($started);
  $rendered = $result->h;
  $salary = $newwork->schedules->jobs->salary;
  $fines = 0;
  $paytype = $newwork->schedules->jobs->paytypes;
  $employer = $newwork->schedules->jobs->users->profile;
  if($paytype->paytype_id == 1){
    $total_salary = $salary * $rendered;
  }
  else{
    $total_salary = $salary;
  }

  $summ = new Work_Summary;
  $summ->work_id = $newwork->work_id;
  $summ->salary = $salary;
  $summ->total_salary = $total_salary;
  $summ->fines = $fines;
  $summ->hours_rendered = $rendered;
  $summ->is_paid = 0;
  $summ->save();

  $summary[] =[
  'work' => $newwork,
  'started' => $started,
  'ended' => $ended,
  'rendered' => $rendered,
  'salary' => $salary,
  'total_salary' => $total_salary,
  'fines' => $fines,
  'paytype' => $paytype,
  'employer' => $employer
  ];



  $data['status'] = 200;
  $data['work'] = $summary;
  return response()->json($data);
}

public function StartJob(Request $req){
  $workid = $req->workid;
  $now = new DateTime;

  $work = Works::where('work_id',$workid)->first();   

  if($work->is_start == 1){
    $data['status'] = 0;
  }
  else{
   $sched = Schedules::where('schedule_id',$work->sched_id)->first();
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

  $work->is_started = 1;
  $work->start_time = $now;
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
$data['end'] = $sched->end;
$data['message'] = 'success';
return response()->json($data);  
}

public function EndJob(Request $req){

  $rate   = $req->rate;
  $desc   = $req->review;
  $workid  = $req->workid;

  $work = Works::where('work_id',$workid)->first();
  $work->status = 4;
  $work->is_started = 0;
  $work->save();

  $review               = new Reviews;
  $review->comment      = $desc;
  $review->rating       = $rate;
  $review->reviewed_id  = $work->employer_id; 
  $review->reviewer_id  = $work->applicant_id;
  $review->work_id      = $workid;
  $review->save();

  $work_reviewed = Work_Reviewed::where('work_id',$workid)->first();
  if(count($work_reviewed) > 0){
    $work_reviewed->applicant_reviewed = 1;
    $work_reviewed->save();

    if($work_reviewed->employer_reviewed == 1){
      $work_reviewed->delete();

      $data['message'] = 'work officialy closed';
    }

    
  }
  else{
    $new_work_review = new Work_Reviewed;
    $new_work_review->work_id = $workid;
    $new_work_review->applicant_reviewed = 1;
    $new_work_review->employer_reviewed = 0;
    $new_work_review->save();
    $data['message'] = 'created a new review';
  }

  $data['status'] = 1;

  return response()->json($data);
}

public function viewJob($id){
  $profile = Profiles::all();
  $skills  = Skills::all();
  $job = Jobs::where('job_id',$id)->first();
  return view('applicant.jobinfo',compact('job','skills','profile'));
}

public function setReschedule(Request $req){

  $workid = $req->workid;
  $st = Carbon::now()->toDateTimeString();
  $work = Works::where('work_id',$workid)->first();
  $sched = Schedules::where('schedule_id',$work->sched_id)->first();
  $sched->start = $st;
  $sched->end = $st;
  $sched->save();

  $data['sched']  = $sched;
  $data['workid'] = $workid;
  $data['start']  = $st;

  $data['status'] = 1;

  return response()->json($data);
}

public function receivePayment(Request $req){
$sumid = $req->sumid;

$sum = Work_Summary::where('summary_id',$sumid)->first();
$sum->delete();
$data['status'] = 200;
  return response()->json($data);
}

}
