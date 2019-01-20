<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\Entity\Address;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class AddressFixtures extends Fixture implements DependentFixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');  
        
        for ($index = 1; $index < 11; $index++) {
            $address = new Address();
            $address->setRoad($faker->unique()->streetAddress)
                    ->setZip(mt_rand(10000, 99999))
                    ->setTown($this->getReference('town_'. mt_rand(1, 10)));
            
            $manager->persist($address);
            
            $this->addReference('address_departure_'. $index, $address);
        }
        
        for ($index = 1; $index < 11; $index++) {
            $address = new Address();
            $address->setRoad($faker->unique()->streetAddress)
                    ->setZip(mt_rand(10000, 99999))
                    ->setTown($this->getReference('town_'. mt_rand(1, 10)));
            
            $manager->persist($address);
            
            $this->addReference('address_arrival_'. $index, $address);
        }
        
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            TownFixtures::class,
        );
    }
        
}
