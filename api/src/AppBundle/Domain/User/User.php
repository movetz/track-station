<?php

namespace AppBundle\Domain\User;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * //TODO: Add password management case
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="guid", unique=true)
     */
    private $uid;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var static
     * @ORM\Column(type="string")
     */
    private $password;

    //TODO: Implement user location feature
    private $location;

    /**
     * User constructor.
     * @param string $uid
     * @param string $email
     * @param string $name
     * @param string $plainPassword
     * @param PasswordEncoderInterface $encoder
     */
    public function __construct(
        string $uid,
        string $email,
        string $name,
        string $plainPassword,
        PasswordEncoderInterface $encoder
    ) {
        $this->uid = $uid;
        $this->email = $email;
        $this->name = $name;
        $this->changePassword($plainPassword, $encoder);

        //TODO: Add domain events
    }

    /**
     * @param string $name
     */
    public function changeName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $plainPassword
     * @param PasswordEncoderInterface $encoder
     */
    public function changePassword(string $plainPassword, PasswordEncoderInterface $encoder)
    {
        $this->password = $encoder->encodePassword($plainPassword, $encoder);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * Is user password valid
     *
     * @param PasswordEncoderInterface $encoder
     * @param mixed $password
     *
     * @return bool
     */
    public function isPasswordValid(PasswordEncoderInterface $encoder, $password): bool
    {
        return $encoder->isPasswordValid($this->password, $password, null);
    }
}