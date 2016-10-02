<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
	protected $table = 'skills';
	protected $primaryKey = 'skill_id';
     public function category()
    {
        return $this->belongsTo('Categories');
    }

}
