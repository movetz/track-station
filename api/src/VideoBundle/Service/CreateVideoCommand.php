<?php

namespace VideoBundle\Service;

use InfrBundle\Service\CommandTagInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateVideoCommand
 * @package AppBundle\Handler\Video
 */
class CreateVideoCommand implements CommandTagInterface
{
    public $uid;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *   min = 3,
     *   max = 50
     * )
     * @var string
     */
    public $name;

    /**
     * @Assert\Length(
     *   max = 300
     * )
     * @var string
     */
    public $description = '';

    /**
     * @var array
     */
    public $tags;

    public $user;
}