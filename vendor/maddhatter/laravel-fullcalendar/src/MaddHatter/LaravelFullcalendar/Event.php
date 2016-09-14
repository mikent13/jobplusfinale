<?php namespace MaddHatter\LaravelFullcalendar;

use DateTime;

interface Event
{
    public function getTitle();
    public function getDescription();
    public function getUser();
    public function getCategory();
    public function getSchedule();
    public function getPaytype();
    public function getSalary();
    public function isAllDay();
    public function getStart();
    public function getEnd();
}