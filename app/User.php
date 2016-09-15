<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table ='users';

    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function job()
    {
        return $this->hasMany('App\Jobs');
    }

    public function appCal()
    {
        return $this->belongsTo('AppCal');
    }

    public function empCal()
    {
        return $this->belongsTo('EmpCal');
    }

    public function profile()
    {
        return $this->belongsTo('Profiles');
    }

    public function appNoti()
    {
        return $this->hasMany('AppNoti');
    }

    public function empNoti()
    {
        return $this->hasMany('EmpNoti');
    }
  

/*    public function skill()
    {
        return $this->hasMany('Skills');   
    }

    public function experience()
    {
        return $this->hasMany('Experiences');
    }*/

 
     public function work()
    {
        return $this->hasMany('Works');
    }

    public function reviews()
    {
        return $this->morphMany('Reviews','reviews');
    }

    public function education()
    {
        return $this->belongsTo('Education');
    }

}
