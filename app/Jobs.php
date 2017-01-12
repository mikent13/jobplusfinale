<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MaddHatter\LaravelFullcalendar\Event;

class Jobs extends Model implements Event
{
    protected $table = 'jobs';
    protected $dates = ['start', 'end'];

 public function getId()
    {
        return $this->job_id;
    }
    public function getUser(){
        return $this->user_id;
    }
    
    public function getCategory(){
        return $this->category_id;
    }
     
    public function getTitle()
    {
        return $this->skill_id;
    }

    public function getDescription(){
        return $this->description;
    }
    public function getLat(){
        return $this->lat;
    }
    public function getLong(){
        return $this->long;
    }
      public function getStart()
    {
        return $this->start_date;
    }
    public function getEnd()
    {
        return $this->end_date;
    }
    public function getPaytype(){
        return $this->paytype;
    }
    public function getSalary(){
        return $this->salary;
    }
    public function isAllDay()
    {
        return $this->is_all_day;
    }
  
  public function getEventOptions()
    {
        return $this->options;
    }
    public function getSlot(){
        return $this->slot;
    }
    public function getDatePosted(){
        return $this->date_posted;
    }

    public function skills()
    {
    	return $this->hasMany('App\Skills','skill_id','skill_id');
    }

}
