<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    const USER_VISITOR_REFERENCE = '_visitor_';
    const USER_CUSTOMER_REFERENCE = '_customer_';

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // ADMIN
        $user = new User();
        $user->setFirstname('Admin')
                ->setLastname('Admin')
                ->setEmail('admin@kaylouer.com')
                ->setRoles(['ROLE_ADMIN'])
                ->setPicture('https://randomuser.me/api/portraits/men/' . mt_rand(0, 99) . '.jpg')
            ;
        $encoded = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($encoded);

        $manager->persist($user);

        // VISITOR
        for ($i = 0; $i < 100; $i++) { 
            $user = new User();
            $user->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName)
                 ->setEmail($faker->email)
                 ->setSlug($faker->slug)
                 ->setRoles(['ROLE_VISITOR'])
                 ->setPicture('https://randomuser.me/api/portraits/men/' . mt_rand(0, 99) . '.jpg')
                 ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(3)) . '</p>')
                ;
            $encoded = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($encoded);

            $manager->persist($user);
        }

        // VISITOR
        for ($i = 0; $i < 200; $i++) { 
            $user = new User();
            $user->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName)
                 ->setEmail($faker->email)
                 ->setSlug($faker->slug)
                 ->setRoles(['ROLE_CUSTOMER'])
                 ->setPicture('https://randomuser.me/api/portraits/men/' . mt_rand(0, 99) . '.jpg')
                 ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(3)) . '</p>')
                ;
            $encoded = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($encoded);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
