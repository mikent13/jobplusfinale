<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
	protected $table = 'skills';


     public function category()
    {
        return $this->belongsTo('Categories');
    }


    	public function user()
    	{
    		return $this->belongsTo('User');
    	}
}
