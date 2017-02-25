<?php

namespace AppBundle\Model\Tests\Domain\User;

use AppBundle\Model\Domain\User\UserBuilder;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Model\Domain\User\User;

/**
 * Class UserBuilder
 * @package AppBundle\Domain\User
 *
 */
class UserBuilderTest extends KernelTestCase
{
    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;
    private $password;
    /**
     * @var UserBuilder
     */
    private $userBuilder;


    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();
        $container = static::$kernel->getContainer();
        $this->encoder = $container->get('domain.user.password_encoder');
        $this->password = 'trackstation';

        $userBuilder = new UserBuilder();
        $userBuilder->withUid('trackstation');
        $userBuilder->withName('trackstation');
        $userBuilder->withEmail('trackstation@trackstation.com');
        $userBuilder->withPassword($this->password, $this->encoder);

        $this->userBuilder = $userBuilder;
    }

    public function testIsUserEncodedPasswordValid()
    {
        $this->assertTrue(
            $this->encoder->isPasswordValid(
                $this->userBuilder->getPassword(),
                $this->password,
                null
            )
        );

        $user = $this->userBuilder->build();
        $this->assertTrue($user->isPasswordValid($this->encoder, $this->password));
    }
}
