<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class UserController extends Controller
{
    public function getProfile($id){

	$users = DB::table('users')
		->join('profiles', 'users.id', '=', 'profiles.user_id')
		->join('prof_educations', 'profiles.id', '=', 'prof_educations.profile_id')
		->join('education', 'prof_educations.education_id', '=', 'education.id')
		->join('degrees', 'education.degree_id', '=', 'degrees.id')
		->select('education.school','education.year', 'degrees.name','users.username','profiles.user_id')
		->where('users.id','=',$id)
		->get();

        return view('users.profile',compact('users'));
    }

    public function getSetup(){
    	return view('users.setup');
    }

    public function saveData(){
        return view('home');
    }

    public function getWallet($id){

    }

    public function getLogs($id){

    }
}
