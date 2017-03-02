<?php

namespace AppBundle\Handler\Video;

use AppBundle\Handler\CommandTag;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateVideoCommand
 * @package AppBundle\Handler\Video
 */
class CreateVideoCommand implements CommandTag
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
     * @var string
     */
    public $description;

    /**
     * @var array
     */
    public $tags;

//    /**
//     * @Assert\Type(type="AppBundle\Handler\User\CreateUserCommand")
//     * @Assert\Valid()
//     *
//     * @var \AppBundle\Handler\User\CreateUserCommand
//     */
//    public $user;
}