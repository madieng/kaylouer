<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Customer;
use App\Entity\Driver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
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
        $user = new Customer();
        $user->setFirstname('Admin')
                ->setLastname('Admin')
                ->setEmail('admin@kaylouer.com')
                ->setRoles(['ROLE_ADMIN'])
                ->setPicture($this->getReference('picture_' . mt_rand(1, 10)))
            ;
        $encoded = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($encoded);

        $manager->persist($user);

        // driver
        for ($i = 1; $i < 11; $i++) { 
            $driver = new Driver();
            $driver->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName)
                 ->setEmail($faker->email)
                 ->setSlug($faker->slug)
                 ->setRoles(['ROLE_VISITOR'])
                 //->setPicture('https://randomuser.me/api/portraits/men/' . mt_rand(0, 99) . '.jpg')
                ->setPicture($this->getReference('picture_' . mt_rand(1, 10)))
                 ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(3)) . '</p>')
                ;
            
            $nbRandomVehicle = mt_rand(1, 2);
            for ($index = 0; $index < $nbRandomVehicle; $index++) {
                $driver->addVehicle($this->getReference('vehicle_' . $faker->numberBetween(1, 20)));
            }
            
            $nbRandomJourney = mt_rand(1, 2);
            for ($index = 0; $index < $nbRandomJourney; $index++) {
                $driver->addJourney($this->getReference('favorite_journey_' . $faker->numberBetween(1, 20)));
            }
            
            $encoded = $this->encoder->encodePassword($driver, 'password');
            $driver->setPassword($encoded);

            $manager->persist($driver);
            
            $this->addReference('driver_'. $i, $driver);
            $this->addReference('user_'. $i, $driver);
        }

        // customer
        for ($i = 1; $i < 21; $i++) { 
            $customer = new Customer();
            $customer->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName)
                 ->setEmail($faker->email)
                 ->setSlug($faker->slug)
                 ->setRoles(['ROLE_CUSTOMER'])
                 //->setPicture('https://randomuser.me/api/portraits/men/' . mt_rand(0, 99) . '.jpg')
                 ->setPicture($this->getReference('picture_' . mt_rand(1, 10)))
                 ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(3)) . '</p>')
                ;
            $encoded = $this->encoder->encodePassword($customer, 'password');
            $customer->setPassword($encoded);

            $manager->persist($customer);
            
            $this->addReference('customer_'. $i, $customer);
            $index = $i + 10;
            $this->addReference('user_'. $index, $customer);
        }

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            PictureFixtures::class,
            VehicleFixtures::class,
            JourneyFixtures::class,
        );
    }
}
