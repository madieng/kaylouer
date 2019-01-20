<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Town;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class TownFixtures extends Fixture {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');  
        
        for ($index = 1; $index < 11; $index++) {
            $town = new Town();
            $town->setLabel($faker->unique()->city);
            
            $manager->persist($town);
            
            $this->addReference('town_'. $index, $town);
        }
        
        $manager->flush();
    }
        
}
