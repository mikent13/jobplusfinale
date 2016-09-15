<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
        protected $table = 'profiles';


    public function user()
    {
    	return $this->belongTo('User');
    }
    public function experience()
    {
        return $this->belongsToMany('App\Experiences','prof_experiences','profile_id','experience_id');
    }

     public function education()
    {
        return $this->belongsToMany('App\Education','prof_educations','profile_id','education_id');
    }

      public function skill()
    {
        return $this->belongsToMany('Skills','prof_skills');   
    }

}
 