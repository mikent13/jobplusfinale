<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoginController extends Controller
{
    public function index(){
    	return view('login.login');
    }

    public function profile(){
    	return view('login.setup');
    }

    public function dashboard(){
    	return view('navbars.primary');
    }
    
    public function job(){
    	return view('applicant.jobpage');
    }
}
