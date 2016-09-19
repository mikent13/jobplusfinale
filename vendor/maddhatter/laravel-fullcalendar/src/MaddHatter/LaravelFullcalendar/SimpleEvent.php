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


    public $id;
    public $title;
    public $is_all_day;
    public $start;
    public $end;
    public $user_id;
    public $category_id;
    public $description;
    public $paytype_id;
    public $salary;
    private $options;
    public $slot;

    public function __construct($title, $isAllDay, $start, $end, $id = null, $options = [],$userid,$categoryid,$description,$paytype,$salary,$slot)
    {
        $this->id       = $id;
        $this->user_id = $userid;
        $this->category_id = $categoryid;
        $this->title    = $title;
        $this->description = $description;
        $this->start    = $start instanceof DateTime ? $start : new DateTime($start);
        $this->end     = $end instanceof DateTime ? $end : new DateTime($end);
        $this->paytype = $paytype;
        $this->salary = $salary;
        $this->is_all_day = $isAllDay;
        $this->options  = $options;
        $this->slot = $slot;
    }

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
        return $this->paytype_id;
    }
    public function getSalary(){
        return $this->salary;
    }
    public function getId()
    {
        return $this->id;
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
    public function isAllDay()
    {
        return $this->is_all_day;
    }

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

}