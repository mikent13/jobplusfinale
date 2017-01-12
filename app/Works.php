<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
	protected $primaryKey = 'work_id';
    protected $table = 'works';
    public $timestamps = false;
    protected $fillable =[
    	'job_id',
    	'status',
    	'user_id',
    	'date'
    ];

}
