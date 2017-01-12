<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
        protected $primaryKey = 'schedule_id';
    	protected $table = 'schedules';
    	protected $fillable =[
    		'job_id',
    		'start',
    		'end'
    	];

    public function user()
    {
    	return $this->belongTo('User');
    }
}

