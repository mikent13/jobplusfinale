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
use Carbon\Carbon;
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



        $userid = Auth::user()->id;
        $profile = Profiles::where('user_id',2)->first();
        $profid = $profile->profile_id;
       
        $pskill = Prof_Skill::where('profile_id',$profid)->get();
        $recskills = array();
        foreach($pskill as $ps){
          $recskills[] = $ps->skill_id;
        }

        $recjobs = Jobs::whereIn('skill_id',$recskills)
                        ->get();

        // foreach($recjobs as $rec){
        //   $ids[] = $rec->job_id;
        // }
        
        $findjob = new FindJobs();
        $skills  = Skills::all();

        $ongoing  = $findjob->ongoingJob();
        $active   = $findjob->activeJob();
        $work     = $findjob->calendarJob();

        if($active){
        $activesched  = Schedules::where('schedule_id',$active)
                              ->first();
        $activework   = Works::where('job_id',$activesched->job_id)
                              ->first();
        $active       = Jobs::where('job_id',$activesched->job_id)
                              ->first();

          $start = $activesched->start = Carbon::parse($activesched->start)->format('h:i A');
          $end   = $activesched->end   = Carbon::parse($activesched->end)->format('h:i A');
        }

        $jobids  = array(); 
         if($work){
            foreach($work as $w){
              $jobids[] = $w->job_id;
            } 
          }

        $databaseEvents = $this->calendarJob->whereIn('job_id',$jobids)->get();
        $calendar       = \Calendar::addEvents($databaseEvents);

        return view('applicant.home',compact('calendar','databaseEvents','skills','active','start','end','activework','recjobs','profile'));
    }

    public function getSkills(Request $req){
      $sk = $req->cat;
      $data['skills'] = Skills::where('category_id',$sk)->get();
      return response()->json($data);
    }

    public function getFilter(Request $req){
      $date = $req->date;
      $salary = $req->salary;
      $ptype = $req->paytype;
      $distance = $req->distance;

      if($date == 0 && $salary == 0 && $distance == 0){
        $job = Jobs::where('paytype',$ptype)->get();
      }
     
    }
    public function getNotification($id){
    
    }

    public function getJobSearch(Request $req){
      $data['job'] = Jobs::where('category_id',$req->cat)->get();
      return response()->json($data);
    }

    public function getAuto(Request $req){
      $skills = Skills::where('name','like','%'.$req->key.'%')->get();
      foreach($skills as $skill){
        $sk[] = $skill->skill_id;
      }
      $jobs=  Jobs::whereIn('skill_id',$sk)->get();      
      $data['j'] = $jobs;
      $data['s'] =$skills; 
      $result = array();
      
      return response()->json($data);
    }

    public function getResult(Request $request){
      $job            = Jobs::where('job_id',$request->jobid)->first();
      $category       = Categories::where('category_id',$job->category_id)->first();
      $sched          = Schedules::where('job_id',$job->job_id)->get();
      $postedby       = Profiles::where('user_id', $job->user_id)->first();
      $skill          = Skills::where('skill_id',$job->skill_id)->first();
      $paytype        = Paytypes::where('paytype_id',$job->paytype)->first();

      $data['paytype'] = $paytype;
      $data['skill'] = $skill;
      $data['user'] = $postedby;
      $data['sched'] = $sched;
      $data['job'] = $job; 
      $data['category'] = $category;
      $data['id'] = $request->jobid;
      return response()->json($data);
    }

    public function getJobPage(){
        // $min           = Input::get('min');
        // $max           = Input::get('max');
        // $housekeeping  = Input::get('housekeeping');
        // $construction  = Input::get('construction');
        // $personel      = Input::get('personel');
        // $maintenance   = Input::get('maintenance');
        // $recjob           = Jobs::whereIn('skill_id',$housekeeping)
        //                        ->whereBetween('salary', array($min,$max))
        //                        ->get();
        return view('applicant.jobpage');
    }

    public function getJobPageData(){
       $data['jobs']           = Jobs::all();
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
      $data['id'] = $req->jobid;
      return response()->json($data);
    }

   public function StartJob($id){
    $wors = Works::where('job_id',$id)
                    ->first();

    if($wors->is_start > 0){
      Session::put('warning','It looks like job has already been started.');
      return redirect()->route('app/dashboard');
   }
  
   $sched = Schedules::where('job_id',$wors->job_id)
                      ->first();

    $time = $sched->start;
    $newtime = Carbon::parse($time)->format('g:i:s A');
    $started = Carbon::now()->format('g:i:s A');

    $result = strtotime($newtime) - strtotime($started);
    if($result <= -1800){
      Session::put('late','You have successfuly started the job but the system has deducted your salary for your shortcoming.');
    }
  
   $wors->is_start = 1;
   $wors->save();

   Session::put('success','You have successfuly started the job.');
   return redirect()->route('app/dashboard');
  }

  public function EndJob(Request $request, $id){
    $rate = Input::get('rate');
    $desc = Input::get('review');
    $worka = Input::get('workid');
   
    $review = new Reviews;
    $review->comment = $desc;
    $review->reviewed_id = $id; 
    $review->rating = $rate;
    $review->reviewer_id = Auth::user()->id;
    $review->work_id = $worka;
    $review->save();

    $werk = Works::where('work_id',$worka)->first();
    $werk->status = 3;
    $werk->is_start = 0;
    $werk->save();

    Session::put('jobend','You have successfuly ended the job.');
    return redirect()->route('app/dashboard');
  }

  public function viewJob($id){
    $profile = Profiles::all();
    $skills  = Skills::all();
    $job = Jobs::where('job_id',$id)->first();
    return view('applicant.jobinfo',compact('job','skills','profile'));
  }

}
