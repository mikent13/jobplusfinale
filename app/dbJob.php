<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dbJob extends Model
{
	protected $table = 'jobs';
        protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'start',
        'end',
        'slot',
        'paytype_id',
        'salary'
    ];
}
