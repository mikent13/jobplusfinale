<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profiles;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;
use Auth;



class UserController extends Controller
{
    public function getHome(){
        return view('home');
    }

    public function getSetup(){

        $housekeeping = DB::table('categories')
            ->join('category_skill','categories.id','=','category_skill.category_id')
            ->leftjoin('skills','category_skill.skill_id','=','skills.id')
            ->select('skills.name','skills.id')
            ->where('categories.id','=',1)
            ->get();
         $personel = DB::table('categories')
            ->join('category_skill','categories.id','=','category_skill.category_id')
            ->leftjoin('skills','category_skill.skill_id','=','skills.id')
            ->select('skills.name','skills.id')
            ->where('categories.id','=',2)
            ->get();
         $maintenance = DB::table('categories')
            ->join('category_skill','categories.id','=','category_skill.category_id')
            ->leftjoin('skills','category_skill.skill_id','=','skills.id')
            ->select('skills.name','skills.id')
            ->where('categories.id','=',3)
            ->get();
         $construction = DB::table('categories')
            ->join('category_skill','categories.id','=','category_skill.category_id')
            ->leftjoin('skills','category_skill.skill_id','=','skills.id')
            ->select('skills.name','skills.id')
            ->where('categories.id','=',4)
            ->get();
     
        return view('users.setup',compact('housekeeping','personel','maintenance','construction'));
    }

    public function saveProfile(Request $request){

    $userid = Auth::user()->id;

    $profile = new Profiles;
        $profile->lname = Input::get("lastname");
        $profile->fname = Input::get("firstname");
        $profile->mobile = Input::get("mobile");
        $profile->biography = Input::get("aboutme");
        $profile->account_no = Input::get("account");
        $profile->key= Input::get("key");
        $profile->lat = Input::get("clat");
        $profile->long = Input::get("clong");
        $profile->user_id = $userid;
        $profile->save();

    $new_prof = Profile::where('user_id',$userid)->get();
    dd($new_prof->id);
    
   $housekeep = $request['housekeeping'];
    if(isset($housekeep[0])) {     
       foreach($housekeep as $hk){
            $hous[] = $hk;
        }
    }

   $construction = $request['construction'];
    if(isset($construction[0])){     
        foreach($construction as $ct){
            $cons[] = $ct;
      } 
    }

   $personel = $request['personel'];
    if(isset($personel[0])){     
       foreach($personel as $ps){
            $pers[] = $ps;        
       }
    }

    $maintenance = $request['maintenance'];
   if(isset($maintenance[0])){     
       foreach($maintenance as $mt){
            $main[] = $mt;        
       }
   }


// Education

       $degree = $request['degree'];
       $year = $request['year'];
       $school = $request['school'];

       foreach($degree as $deg){
            $edu['degree'] = $degree;
            $edu['year'] = $year;
            $edu['school'] = $school; 
       }

// Work
        $work= $request['work'];
        $work_year= $request['work_year'];
        $employer= $request['employer'];

        foreach($work as $wo){
            $works['work'] = $work;
            $works['work_year'] = $work_year;
            $works['employer'] = $employer; 
       }

        return view('users.test',compact('hous','cons','pers','main'));
    }

    public function getWallet($id){

    }

    public function getLogs($id){

    }
}
