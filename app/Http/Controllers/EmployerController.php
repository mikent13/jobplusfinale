<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Job;
use App\Work;


class EmployerController extends Controller
{
     public function index(){
     	$jobs = Job::all();
    	return view('employer.home',compact('jobs'));
    }

    public function getApply($id){
    	
    }

}
