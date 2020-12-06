<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setPassword(
            $this->encoder->encodePassword($user, '123456')
        );
        $user->setEmail('a@a.com');
        $user->setPhoneNumber('+37069781645');
        $user->setName("Admin");
        $user->setSurname("Administrator");
        $user->addRole('ROLE_ADMIN');

        $manager->persist($user);
        $manager->flush();
    }
}
