<?php

namespace UserBundle\Domain;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * Class UserBuilder
 * @package AppBundle\Domain\User
 *
 */
class UserBuilder
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @param string $uid
     * @return UserBuilder
     */
    public function withUid(string $uid): self
    {
        $this->options['uid'] = $uid;
        return $this;
    }

    /**
     * @param string $name
     * @return UserBuilder
     */
    public function withName(string $name): self
    {
        $this->options['name'] = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return UserBuilder
     */
    public function withEmail(string $email): self
    {
        $this->options['email'] = $email;
        return $this;
    }

    /**
     * @param string $plain
     * @param PasswordEncoderInterface $encoder
     * @return UserBuilder
     */
    public function withPassword(string $plain, PasswordEncoderInterface $encoder): self
    {
        $this->options['password'] = $encoder->encodePassword($plain, null);
        return $this;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->options['uid'];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->options['email'];
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->options['password'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->options['name'];
    }

    /**
     * @return User
     */
    public function build(): User
    {
        return new User($this);
    }
}
