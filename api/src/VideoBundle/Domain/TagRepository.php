<?php

namespace VideoBundle\Domain;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TagRepository
 * @package VideoBundle\Domain
 */
class TagRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * VideoRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $name
     * @return Tag
     */
    public function getTag(string $name): Tag
    {
        $tag = $this->em->getRepository(Tag::class)->findOneBy(['name' => $name]);

        if ($tag) {
            return $tag;
        }

        $tag = new Tag($name);
        $this->em->persist($tag);

        return $tag;
    }
}
