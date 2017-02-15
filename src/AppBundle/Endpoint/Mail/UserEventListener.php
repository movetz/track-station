<?php

namespace AppBundle\Endpoint\Mail;

use AppBundle\Handler\User\Event\UserCreatedEvent;
use Swift_Mailer as Mailer;
use Swift_Message;

/**
 * Class UserEventListener
 * @package AppBundle\Endpoint\Mail
 */
class UserEventListener
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * UserEventListener constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param UserCreatedEvent $event
     */
    public function onUserCreated(UserCreatedEvent $event)
    {
        $user = $event->getUser();

        $message = Swift_Message::newInstance()
            ->setSubject('Welcome in Video Station')
            ->setFrom('admin@vstation.io')
            ->setTo($user->getEmail())
            ->setBody('');

        $this->mailer->send($message);
    }
}
