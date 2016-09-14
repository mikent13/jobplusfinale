<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiences extends Model
{
 

 		protected $table = 'experiences';
  

    	public function user()
    	{
    		return $this->belongsTo('User');
    	}
}
