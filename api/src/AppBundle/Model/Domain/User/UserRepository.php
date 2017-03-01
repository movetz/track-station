<?php

namespace AppBundle\Model\Domain\User;

use AppBundle\Model\Domain\User\Exception\UserConflictException;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserRepository
 * @package AppBundle
 */
class UserRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        //TODO: Add checking or change hydration mode
        if ($this->getEmRepository()->findOneBy(['email' => $user->getEmail()])) {
            throw new UserConflictException();
        }

        if ($this->getEmRepository()->findOneBy(['uid' => $user->getUid()])) {
            throw new UserConflictException();
        }

        $this->em->persist($user);
    }

    /**
     * @return ObjectRepository
     */
    private function getEmRepository() : ObjectRepository
    {
        return $this->em->getRepository(User::class);
    }
}