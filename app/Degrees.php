<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degrees extends Model
{
    	protected $table = 'degrees';

      public function education()
    {
        return $this->belongsTo('Education');   
    }
}
