<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
   
		protected $table = 'reviews';


    public function reviews()
    {
    	return $this->morphTo();
    }
}
