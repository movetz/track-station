<?php

namespace InfrBundle\Domain\Event;

/**
 * Class DomainEventProviderTrait
 * @package InfrBundle\Domain\Event
 */
trait DomainEventProviderTrait
{
    /**
     * @var array
     */
    private $events = [];

    /**
     * @return array
     */
    public function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }

    /**
     * @param $event
     */
    public function raise($event)
    {
        $this->events[] = $event;
    }
}