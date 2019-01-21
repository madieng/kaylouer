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
use App\Entity\Vehicle;

/**
 * Description of VehicleFixtures
 *
 * @author franchesco971
 */
class VehicleFixtures extends Fixture implements DependentFixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');  
        
        for ($index = 1; $index < 21; $index++) {
        
            $vehicle = new Vehicle();
            $vehicle->setBrand($this->getReference('brand_' . $faker->numberBetween(1, 20)))
                    ->setModel($faker->unique()->words(3, true));
                    
            $nbPictures = $faker->numberBetween(0, 5);

            if($nbPictures) {
                for ($index1 = 0; $index1 < $nbPictures; $index1++) {
                    $vehicle->addPicture($this->getReference('picture_vehicle_'. $faker->numberBetween(1, 10)));
                }
            }
                    
            
            $manager->persist($vehicle);
            
            $this->addReference('vehicle_'. $index, $vehicle);
        }
        
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            BrandFixtures::class,
            PictureFixtures::class,
        );
    }
}
