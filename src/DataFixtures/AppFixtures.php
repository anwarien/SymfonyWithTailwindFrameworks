<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{ 
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadPosts($manager);
    }

   
    public function loadUsers(ObjectManager $manager){
        $user = new User();
        $user->setUsername('admin1');
        $user->setFullname('Haitam Ghalem');
        $user->setEmail('pro.haitamghalem@gmail.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user, 'admin123'
            )
            );
        $this->addReference('admin123', $user);    
        $manager->persist($user);
        $manager->flush();
    }

    public function loadPosts(ObjectManager $manager){
         // $product = new Product(); img body time
        // the array
        $arrImg = array("https://img.etimg.com/thumb/msid-68721417,width-643,imgsize-1016106,resizemode-4/nature1_gettyimages.jpg",
                      "https://sm.pcmag.com/pcmag_uk/guide/t/the-best-w/the-best-web-hosting-services-for-2019_ssz5.jpg",
                      "https://www.cnetfrance.fr/i/edit/2019/07/iphone-11-XI-prix-sortie.jpg",
                      "https://images.clickittech.com/wp-content/uploads/2018/06/01104411/Laravel-vs-Symfony-02.png",
                      "https://www.theladders.com/wp-content/uploads/Lion_030818-800x450.jpg",
                      "https://www.worldatlas.com/r/w728-h425-c728x425/upload/fa/99/3d/shutterstock-1047598105.jpg",
                      "https://images.fineartamerica.com/images-medium-large-5/group-of-happy-african-children-east-africa-hadynyah.jpg",
                      "https://images.idgesg.net/images/article/2019/06/iot_internet-of-things_chains_security_by-mf3d-getty-100799692-large.jpg");
    

        for($i=1;$i<99;$i++){
            $post = new Post();
            $post->setTitle('This is my title '.$i);
            $post->setUrldetail('This-is-my-title-'.$i);
            $post->setImg($arrImg[array_rand($arrImg)]);
            $post->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
            $post->setTime(new \DateTime());
            $post->setUser($this->getReference('admin123'));
            $manager->persist($post);
        }
        
        $manager->flush();
    }
        
    
}
