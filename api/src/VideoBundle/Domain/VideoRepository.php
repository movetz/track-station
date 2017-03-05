<?php

namespace VideoBundle\Domain;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class VideoRepository
 * @package AppBundle\Model\Domain\Video
 */
class VideoRepository
{
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
     * @param Video $video
     */
    public function add(Video $video)
    {
        $this->em->persist($video);
    }
}