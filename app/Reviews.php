<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
   protected $primaryKey = 'review_id';
	protected $table = 'reviews';
	public $timestamps = false;
	protected $fillable =[
		'rating',
		'comment',
		'reviewed_id',
		'reviewer_id',
		'work_id'
	];


}
