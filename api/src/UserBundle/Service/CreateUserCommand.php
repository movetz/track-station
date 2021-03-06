<?php

namespace UserBundle\Service;

use InfrBundle\Service\CommandTagInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateUserCommand
 * @package AppBundle\Handler\User
 */
class CreateUserCommand implements CommandTagInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *   min = 3,
     *   max = 50
     * )
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Length(
     *      min = 2,
     *      max = 255
     * )
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 8,
     *      max = 10
     * )
     */
    public $password;

    public $uid;

    public $photo;
}