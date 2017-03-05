<?php

namespace InfrBundle\Domain\Event;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\UnitOfWork;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Dispatcher
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    private $flushedInternally = false;

    /**
     * Dispatcher constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }


    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if ($this->flushedInternally) {
            $this->flushedInternally = false;
            return;
        }

        $em = $eventArgs->getEntityManager();
        $this->dispatchEvents($em->getUnitOfWork());

        $this->flushedInternally = true;
        $em->flush();
    }

    private function dispatchEvents(UnitOfWork $unitOfWork)
    {
        foreach ($unitOfWork->getIdentityMap() as $class => $entities) {
            foreach ($entities as $entity) {
                if ($entity instanceof DomainEventProviderInterface) {
                    foreach ($entity->popEvents() as $event) {
                        $this->eventDispatcher->dispatch($event->getEventName(), $event);
                    }
                }
            }
        }
    }
}