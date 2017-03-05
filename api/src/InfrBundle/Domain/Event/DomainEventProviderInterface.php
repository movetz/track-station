<?php

namespace InfrBundle\Domain\Event;

interface DomainEventProviderInterface
{
    public function popEvents(): array;
}