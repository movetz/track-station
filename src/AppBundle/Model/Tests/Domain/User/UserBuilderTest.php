<?php

namespace AppBundle\Model\Tests\Domain\User;

use AppBundle\Model\Domain\User\UserBuilder;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UserBuilder
 * @package AppBundle\Domain\User
 *
 */
class UserBuilderTest extends KernelTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();
        $container = static::$kernel->getContainer();
        $this->encoder = $container->get('domain.user.password_encoder');
    }

    public function testIsUserEncodedPasswordValid()
    {
        $userBuilder = new UserBuilder();

        $password = 'trackstation';
        $userBuilder->withPassword($password, $this->encoder);

        $this->assertTrue($this->encoder->isPasswordValid($userBuilder->getPassword(), $password, null));
    }
}
