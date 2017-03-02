<?php

namespace AppBundle\Handler\User\Event;

use AppBundle\Model\Domain\User\User;

/**
 * Class UserCreatedEvent
 * @package AppBundle\Handler\User\Event
 */
class UserCreatedEvent
{
    const NAME = 'app.user.created';

    /**
     * @var User
     */
    private $user;

    /**
     * UserCreatedEvent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}