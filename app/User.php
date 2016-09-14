<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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


    public function profile()
    {
        return $this->belongsTo('Profiles');
    }

    public function skill()
    {
        return $this->hasMany('Skills');   
    }

    public function experience()
    {
        return $this->hasMany('Experiences');
    }
    public function appNoti()
    {
        return $this->hasMany('AppNoti');
    }
    public function appCal()
    {
        return $this->belongsTo('AppCal');
    }
    public function empCal()
    {
        return $this->belongsTo('EmpCal');
    }
    public function empNoti()
    {
        return $this->hasMany('EmpNoti');
    }
    public function job()
    {
        return $this->hasMany('Jobs');
    }

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
