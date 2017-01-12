<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Profiles;
use App\Skills;
use App\Prof_Skill;
use App\Paytypes;
use App\Degrees;
use App\Attainment;
use App\Field_study;
use App\Education;
use App\Experiences;
use App\Prof_Edu;
use App\Prof_Exp;
use App\Jobs;
use App\Job_Skill;
use App\Job_Address;
use App\Schedules;
use App\Categories;
use App\Prof_mobile;
use Borla\Chikka\Chikka;

class ProfileController extends Controller
{
	public function getSkill(){
		$id = Auth::user()->id;
		$profile = Profiles::where('user_id',$id)->first();
		$pskill = Prof_Skill::where('profile_id',$profile->profile_id)->get();
		$skid = [];

		if(count($pskill) > 0){
			foreach($pskill as $ps){
				$skid[] = $ps->skill_id;
			}

			$data['pskill'] = $skid;
		}
		else{
			$data['pskill'] = 0;
		}


		$housekeeping = Skills::where('category_id',1)->get();
		$construction = Skills::where('category_id',2)->get();
		$personel = Skills::where('category_id',3)->get();
		$maintenance = Skills::where('category_id',4)->get();

		$data['house'] = $housekeeping;
		$data['cons'] = $construction;
		$data['pers'] = $personel;
		$data['main'] = $maintenance;
		
		return response()->json($data);
	}

	public function updateSkill(Request $req){
		$skills = [];
		$skills[] = $req->skills;

		$id = Auth::user()->id;
		$profile = Profiles::where('user_id',$id)->first();
		$pskill = Prof_Skill::where('profile_id',$profile->profile_id)->get();

		if(count($pskill)>0){
			foreach($pskill as $ps){
				$ps->delete();
			}
		}

		$size = 0;
		foreach($skills as $sk){
			$size += count($sk);
		}
		if($size > 0){
			for($i=0; $i<$size; $i++){
				$prof_sk = new Prof_Skill;
				$prof_sk->profile_id = $profile->profile_id;
				$prof_sk->skill_id = $skills[0][$i];
				$prof_sk->save();
			}
			$data['skill'] = 1;
		}
		else{
			$data['skill'] = 0;
		}
		$data['status'] = 1;
		return response()->json($data);
	}

	public function setName(Request $req){
	$fname = $req->fname;
	$lname = $req->lname;
	$address = $req->address;
	$id = Auth::user()->id;
	$profile = Profiles::where('user_id',$id)->first();	
	$profile->fname = $fname;
	$profile->lname = $lname;
	$profile->address = $address;
	$profile->save();
	$data['status'] = 1;
	return response()->json($data);	
	}

	public function setoverview(Request $req){
	$overview = $req->overview;
	$id = Auth::user()->id;
	$profile = Profiles::where('user_id',$id)->first();	
	$profile->biography = $overview;
	$profile->save();
	$data['status'] = 1;
	return response()->json($data);	
	}
}
