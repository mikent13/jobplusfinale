<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class UserController extends Controller
{
    public function getHome(){
        return view('home');
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
