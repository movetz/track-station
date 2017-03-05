<?php

namespace UserBundle\Service;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use UserBundle\Domain\{
    User, UserBuilder, UserRepository
};

/**
 * Class CreateUserHandler
 * @package UserBundle\Service
 */
class CreateUserHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EncoderFactory
     */
    private $encoderFactory;

    /**
     * CreateUserHandler constructor.
     * @param UserRepository $userRepository
     * @param EncoderFactory $encoderFactory
     */
    public function __construct(UserRepository $userRepository, EncoderFactory $encoderFactory)
    {
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param CreateUserCommand $command
     */
    public function __invoke(CreateUserCommand $command)
    {
        //TODO: Add mailer
        $user = (new UserBuilder())
            ->withUid($command->uid)
            ->withEmail($command->email)
            ->withName($command->name)
            ->withPassword($command->password, $this->encoderFactory->getEncoder(User::class))
            ->build();

        $this->userRepository->add($user);
    }
}