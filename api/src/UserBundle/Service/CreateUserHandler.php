<?php

namespace UserBundle\Service;

use AppBundle\Model\Domain\User\UserBuilder;
use UserBundle\Domain\UserRepository;

/**
 * Class CreateUserHandler
 * @package UserBundle\Service
 */
class CreateUserHandler
{
    private $userRepository;

    /**
     * CreateUserHandler constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CreateUserCommand $command
     */
    public function __invoke(CreateUserCommand $command)
    {
        $user = (new UserBuilder())
            ->withUid($command->uid)
            ->withEmail($command->email)
            ->withName($command->name)
            ->build();

        $this->userRepository->add($user);
    }
}