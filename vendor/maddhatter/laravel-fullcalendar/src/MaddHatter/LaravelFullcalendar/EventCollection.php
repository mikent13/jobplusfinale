<?php namespace MaddHatter\LaravelFullcalendar;

use Illuminate\Support\Collection;

class EventCollection
{
    /**
     * @var Collection
     */

    protected $events;

    public function __construct()
    {
        $this->events = new Collection();
    }

    public function push(Event $event, array $customAttributes = [])
    {
        $this->events->push($this->convertToArray($event, $customAttributes));
    }

    public function toJson()
    {
        return $this->events->toJson();
    }

    public function toArray()
    {
        return $this->events->toArray();
    }

    private function convertToArray(Event $event, array $customAttributes = [])
    {
        $eventArray = [
            'id' => $this->getEventId($event),
            'user_id' => $event->getUser(),
             'category' => $event->getCategory(),
             'title' => $event->getTitle(),
             'description' => $event->getDescription(),
             'start' => $event->getStart()->format('c'),
            'end' => $event->getEnd()->format('c'),
            'paytype_id' => $event->getPaytype(),
            'salary' => $event->getSalary(),
            'is_all_day' => $event->isAllDay(),
            'slot' => $event->getSlot()
        ];

        $eventOptions = [];

        return array_merge($eventArray, $eventOptions, $customAttributes);
    }
    
    private function getEventId(Event $event)
    {
        if ($event instanceof IdentifiableEvent) {
            return $event->getId();
        }

        return null;
    }
}