<?php

namespace UserBundle\Domain;

use InfrBundle\Domain\Event\DomainEventInterface;
use Symfony\Component\EventDispatcher\Event;

class UserCreatedEvent extends Event implements DomainEventInterface
{
    const EVENT_NAME = 'user.created';

    private $id;

    private $email;

    private $name;

    public function __construct(string $id, string $email, string $name)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
    }

    public function getEventName(): string
    {
        return self::EVENT_NAME;
    }

    public function getMessageHeader()
    {
        // TODO: Implement getMessageHeader() method.
    }

    public function getAggregateId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}