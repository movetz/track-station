<?php

namespace AppBundle\Handler\User;

use AppBundle\Model\Domain\User\{
    UserRepository, UserBuilder
};
use AppBundle\Handler\User\Event\UserCreatedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * Class CreateUserHandler
 * @package AppBundle\Handler\User
 */
class CreateUserHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;

    /**
     * CreateUserHandler constructor.
     * @param UserRepository $repository
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserRepository $repository,
        EventDispatcherInterface $dispatcher,
        PasswordEncoderInterface $encoder
    ) {
        $this->repository = $repository;
        $this->dispatcher = $dispatcher;
        $this->encoder = $encoder;
    }

    /**
     * @param CreateUserCommand $command
     */
    public function __invoke(CreateUserCommand $command)
    {
        $builder = new UserBuilder();

        $builder
            ->withUid($command->uid)
            ->withEmail($command->email)
            ->withName($command->name)
            ->withPassword($command->password, $this->encoder);

        $user = $builder->build();
        $this->repository->add($user);

        $this->dispatcher->dispatch(UserCreatedEvent::NAME, new UserCreatedEvent($user));
    }
}
