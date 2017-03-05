<?php

namespace UserBundle\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use UserBundle\Domain\User;

/**
 * Class GetUserQuery
 * @package UserBundle\Query
 */
class GetUserQuery
{
    /**
     * @var string
     */
    private $uid;

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
     * @param string $id
     * @return $this
     */
    public function byUid(string $id)
    {
        $this->uid = $id;
        return $this;
    }

    public function withFields()
    {
        return $this;
    }

    /**
     * @return array
     */
    public function execute(): array
    {
        $query =  $this->qb
            ->select('u.uid, u.name, u.email')
            ->from(User::class, 'u')
            ->andWhere('u.uid = :uid')
            ->setParameter('uid', $this->uid)
            ->getQuery();

        //TODO: Add Exception
        $view = $query->getSingleResult(Query::HYDRATE_ARRAY);

//        if (!$userView) {
//            throw new UserNotFoundException();
//        }

        return $view;
    }
}