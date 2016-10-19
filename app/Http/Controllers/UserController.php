<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profiles;
use App\Skills;
use App\Prof_Skill;
use App\Degrees;
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
        $housekeeping = Skills::where('category_id',1)->get();
        $construction = Skills::where('category_id',2)->get();
        $personel = Skills::where('category_id',3)->get();
        $maintenance = Skills::where('category_id',4)->get();
        $degree = Degrees::all();
        
        return view('users.setup',compact('housekeeping','personel','maintenance','construction','degree'));
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

    $new_prof = Profiles::where('user_id',$userid)->firstOrFail();
    $profid = $new_prof->profile_id;
    
   $housekeep = Input::get('housekeeping');
    if(isset($housekeep[0])) {     
       foreach($housekeep as $hk){
            $house = new Prof_Skill;
            $house->profile_id = $profid;
            $house->skill_id = $hk;
            $house->save();
        }
    }

   $construction = $request['construction'];
    if(isset($construction[0])){     
        foreach($construction as $ct){
            $construct = new Prof_Skill;
            $construct->profile_id = $profid;
            $construct->skill_id = $ct;
            $construct->save();
      } 
    }

   $personel = $request['personel'];
    if(isset($personel[0])){     
       foreach($personel as $ps){
            $person = new Prof_Skill;
            $person->profile_id = $profid;
            $person->skill_id = $ps;
            $person->save();
       }
    }

    $maintenance = $request['maintenance'];
   if(isset($maintenance[0])){     
       foreach($maintenance as $mt){
            $mainte = new Prof_Skill;
            $mainte->profile_id = $profid;
            $mainte->skill_id = $mt;
            $mainte->save();        
       }
   }

// Education
       $degree = Input::get('degrees');
       $year = Input::get('year');
       $school = Input::get('school');
  
        return redirect()->route('user/home');
    }

    public function getWallet($id){

    }

    public function getLogs($id){

    }
}
