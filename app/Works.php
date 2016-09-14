<?php

namespace Job;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    
        protected $table = 'works';

    public function appCal()
    {
    	return $this->belongsTo('AppCal');
    }
    public function empCal()
    {
    	return $this->belongsTo('EmpCal');
    }
    public function user()
    {
    	return $this->belongsTo('User');
    }
    public function job()
    {
    	return $this->belongsTo('Jobs');
    }




}
