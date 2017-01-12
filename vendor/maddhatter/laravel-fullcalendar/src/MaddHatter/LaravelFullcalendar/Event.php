<?php namespace MaddHatter\LaravelFullcalendar;

use DateTime;

interface Event
{
    public function getId();
    public function getUser();
    public function getCategory();
    public function getTitle();
    public function getDescription();
    public function getLat();
    public function getLong();
    public function getStart();
    public function getEnd();
    public function getPaytype();
    public function getSalary();
    public function isAllDay();
    public function getSlot();
    public function getDatePosted();
}

