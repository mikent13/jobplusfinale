<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    	protected $table = 'education';

     public function degree()
    {
        return $this->hasMany('App\Degrees');   
    }

    public function profile(){
    	return $this->belongsToMany('App\Profile');
    }

}
