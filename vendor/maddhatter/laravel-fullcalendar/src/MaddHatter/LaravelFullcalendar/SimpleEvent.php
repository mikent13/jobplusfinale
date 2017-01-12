<?php namespace MaddHatter\LaravelFullcalendar;

use DateTime;

/**
 * Class SimpleEvent
 *
 * Simple DTO that implements the Event interface
 *
 * @package MaddHatter\LaravelFullcalendar
 */

class SimpleEvent implements IdentifiableEvent
{
    public $job_id;
    public $skill_id;
    public $is_all_day;
    public $start_date;
    public $end_date;
    public $user_id;
    public $category_id;
    public $description;
    public $lat;
    public $long;
    public $paytype;
    public $salary;
    private $options;
    public $slot;
    public $date_posted;

    public function __construct($id = null,$user,$category,$skill,$description,$lat,$long,$start, $end,$paytype,$salary,$isAllDay,$slot,$date_posted,$options = [])
    {
        $this->job_id       = $id;
        $this->user_id = $user;
        $this->category_id = $category;
        $this->skill_id    = $skill;
        $this->description = $description;
        $this->lat = $lat;
        $this->long = $long;
        $this->start_date    = $start instanceof DateTime ? $start : new DateTime($start);
        $this->end_date     = $end instanceof DateTime ? $end : new DateTime($end);
        $this->paytype = $paytype;
        $this->salary = $salary;
        $this->is_all_day = $isAllDay;
        $this->options  = $options;
        $this->slot = $slot;
        $this->date_posted = $date_posted;
    }

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

}