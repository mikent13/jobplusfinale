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
use Borla\Chikka\Chikka;
use Auth;
use Session;

class UserController extends Controller
{
    public function getHome(){
        return view('home');
    }

    public function getProfile(){
      return view('users.app-profile');
  }

  public function ChikkaSend(Request $req){
        $mobile = '09335532300';
        $message = 'Hello world';
        
        $config = [
            'shortcode'=> '292902017',
            'client_id'=> 'b00de5e0839604cdfe07a9e7b5e6c8127ef4bf36ab3b44c0b287ae0603a678c0',
            'secret_key'=> 'aed7fabd8a0864f8c5a61b5f4dfb4fd3d1737e81d792ff22a3639748391d3612',
        ];

        $chikka = new Chikka($config);
        $resp = $chikka->send($mobile, $message);
        // $data['response'] = 'response';
        // return view('masters.sms',compact('response'));
        return response()->json($data);
    }

    public function ChikkaReceive(Request $req){
        $config = [
            'shortcode'=> '292902017',
            'client_id'=> 'b00de5e0839604cdfe07a9e7b5e6c8127ef4bf36ab3b44c0b287ae0603a678c0',
            'secret_key'=> 'aed7fabd8a0864f8c5a61b5f4dfb4fd3d1737e81d792ff22a3639748391d3612',
        ];
    
    dd(Input::all());


    // Process message
    // ->message(function($message) {
    //     // Do whatever you want to do with the message
    //     $content = $message->content;
    //     Session::put('cont',$content);
    //     $sender = $message->mobile;
    //     // Return true to tell Chikka that you have successfully received the message
    //     return true;
    // });;
    // $data['mes'] = $chikka->receive($_POST)->getMessage();    

    }

      private function processMessage($message, $sender) {
        // Get message content
        $content = $message->content;

        // Set new content for replying to message
        $message->content = 'Hello to you, too';
        // Set message id as null (to force the Message object to generate a new message id)
        $message->id = null;
        // Set cost
        $message->cost = 2.50;
        // Send reply
        $response = $sender->reply($message);
        // New message id
        $messageId = $response->attachments->message->id;
        // Return true to tell Chikka that you have successfully received the message
        return true;
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
