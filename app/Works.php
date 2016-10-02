<?php

namespace Job;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
	protected $primaryKey = 'work_id';
    protected $table = 'works';
    protected $fillable =[
    	'job_id',
    	'status',
    	'user_id'
    ];

}
