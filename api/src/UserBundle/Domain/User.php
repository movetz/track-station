<?php

namespace UserBundle\Domain;

use InfrBundle\Domain\Event\{
    DomainEventProviderTrait, DomainEventProviderInterface
};
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * //TODO: Add password management case
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User implements DomainEventProviderInterface, UserInterface
{
    use DomainEventProviderTrait;

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=8, options={"fixed" = true})
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
     * @param UserBuilder $builder
     */
    public function __construct(UserBuilder $builder) {
        $this->uid = $builder->getUid();
        $this->email = $builder->getEmail();
        $this->name = $builder->getName();
        $this->password = $builder->getPassword();

        $this->raise(new UserCreatedEvent($this->uid, $this->email, $this->name));
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

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
    }
}
