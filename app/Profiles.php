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
        return $this->hasMany('Experiences');
    }

     public function education()
    {
        return $this->belongsTo('Education');
    }
      public function skill()
    {
        return $this->hasMany('Skills');   
    }

}
