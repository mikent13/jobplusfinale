<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MaddHatter\LaravelFullcalendar\Event;

class Jobs extends Model implements Event
{

    protected $table = 'jobs';
    protected $dates = ['start', 'end'];

    public function getSlot(){
        return $this->slot;
    }

    public function getUser(){
        return $this->user_id;
    }
    public function getCategory(){
        return $this->category_id;
    }
    public function getDescription(){
        return $this->description;
    }

    public function getPaytype(){
        return $this->paytype;
    }
    public function getSalary(){
        return $this->salary;
    }
    public function getId()
    {
        return $this->id;
    }
   public function isAllDay()
    {
        return $this->is_all_day;
    }
    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
 

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get the optional event options
     *
     * @return array
     */
    public function getEventOptions()
    {
        return $this->options;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories');
    }

    public function payType()
    {
    	return $this->belongsTo('App\Paytypes');
    }

    public function skill()
    {
    	return $this->hasMany('App\Skills');
    }

    
}
