<?php

namespace InfrBundle\Domain\Event;

/**
 * Interface DomainEventInterface
 * @package InfrBundle\Domain\Event
 */
interface DomainEventInterface
{
    /**
     * @return string
     */
    public function getEventName(): string;
}