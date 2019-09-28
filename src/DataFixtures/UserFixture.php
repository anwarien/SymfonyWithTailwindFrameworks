<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    /*
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }
    */
    public function load(ObjectManager $manager)
    {
        /*
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setUsername('admin1');
        $user->setFullname('Haitam Ghalem');
        $user->setEmail('pro.haitamghalem@gmail.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user, 'admin123'
            )
            );
        $manager->persist($user);
        $manager->flush();
        */
    }
    
}
