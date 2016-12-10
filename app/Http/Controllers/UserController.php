<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profiles;
use App\Skills;
use App\Prof_Skill;
use App\Paytypes;
use App\Degrees;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;
use App\Jobs;
use App\Job_Skill;
use App\Job_Address;
use App\Schedules;
use App\Categories;
use Auth;
class UserController extends Controller
{
    public function getHome(){
        return view('home');
    }

    public function getProfile(){
      return view('users.app-profile');
  }
  public function ChikkaSend(Request $req){
    $client = env('CHIKKA_CLIENT_ID');
        $secret = env('CHIKKA_CLIENT_SECRET');
        $shortcode = env('CHIKKA_CLIENT_SHORTCODE');
       
        $number =  $req->number;
        $message = $req->message;

        // Validate API
        if ( (empty($client)) || (empty($secret)) || (empty($shortcode)) ) {
            $request->session()->flash('error', 'You have incomplete Chikka SMS API credentials.');
        }

       
        // Send
        $arr_post_body = array(
            "message_type"      =>      "SEND",
            "mobile_number"     =>      $number,
            "shortcode"         =>      $shortcode,
            "message_id"        =>      str_random(32),
            "message"           =>      urlencode($message),
            "client_id"         =>      $client,
            "secret_key"        =>      $secret
        );
    
        $query_string = "";
        foreach($arr_post_body as $key => $frow)
        {
            $query_string .= '&'.$key.'='.$frow;
        }

        $URL = "https://post.chikka.com/smsapi/request";

        $curl_handler = curl_init();
        curl_setopt($curl_handler, CURLOPT_URL, $URL);
        curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
        curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
        curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_handler, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($curl_handler);
        
        curl_close($curl_handler);
        $resp = json_decode($response);

        if($resp->status == 200){
            $data['status'] ='success';
        }
        else{
             $data['status'] ='failed';
        }

        // // End of Send sms
        $data['response'] = $resp;
        // $data['number'] = $number;
        // $data['message'] = $message;
        return response()->json($data);
    }

    public function ChikkaReceive(Request $req){
   
        $data['message'] = $req->input('message');
        $data['mobile'] = $req->input('mobile_number');
      return response()->json($data);
    }

    public function getSMSPage(){
        return view('masters.sms');
    }

    public function getAdmin(){
        $job = Jobs::all();
        $skill = Job_Skill::all();
        $sk = Skills::all();
        $address = Job_Address::all();
        $paytype = Paytypes::all();
        $schedule = Schedules::all();
        $category = Categories::all();
        return view('masters.admin',compact('job','skill','sk','address','paytype','schedule','category'));
    }
    public function getProfileData(){
        $skill_ids = [];
        $id = Auth::user()->id;
        $profile = Profiles::where('user_id',$id)->first();
        $prof_skills = Prof_Skill::where('profile_id',$profile->profile_id)->get();

        foreach($prof_skills as $skills){
            $skill_ids[] = $skills->skill_id;
        }

        $newskill = Skills::whereIn('skill_id',$skill_ids)->get();

        $data['profile'] = $profile;
        $data['skills'] = $newskill;
        $data['message'] = 'success';
        return response()->json($data);
    }

    public function updateName(Request $req){
        $id = Auth::user()->id;
        $profile = Profiles::where('user_id',$id)->first();
        $profile->fname = $req->fname;
        $profile->lname = $req->lname;
        $profile->save();
        $data['message'] = 'success';
        return response()->json($data);
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
