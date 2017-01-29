<?php

namespace AppBundle\Model\Query\User;

use AppBundle\Model\Domain\User\User;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

/**
 * Class GetUserQuery
 * @package AppBundle\Domain\User\Query
 */
class GetUserQuery
{
    /**
     * @var QueryBuilder
     */
    private $qb;

    /**
     * GetUserQuery constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->qb = $em->createQueryBuilder();
    }

    /**
     * @param string $uid
     * @return array
     */
    public function execute(string $uid): array
    {
        $query =  $this->qb
            ->select('u.uid, u.name, u.email')
            ->from(User::class, 'u')
            ->andWhere('u.uid = :uid')
            ->setParameter('uid', $uid)
            ->getQuery();

        $userView = $query->getSingleResult(Query::HYDRATE_ARRAY);

        if (!$userView) {
            throw new UserNotFoundException();
        }

        return $userView;
    }
}