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
use App\Entity\Picture;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class PictureFixtures extends Fixture {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');  
        
        for ($index = 1; $index < 11; $index++) {
            $picture = new Picture();
            $gender = $faker->randomElement(['men','women']);
            $picture->setPath('https://randomuser.me/api/portraits/'. $gender .'/' . mt_rand(0, 99) . '.jpg')
                    ->setExtension('jpg')
                    ->setSize($faker->numberBetween(1, 1000));
            
            $manager->persist($picture);
            
            $this->addReference('picture_'. $index, $picture);
        }
        
        for ($index = 1; $index < 11; $index++) {
            $picture = new Picture();
            $gender = $faker->randomElement(['men','women']);
            $picture->setPath('http://lorempixel.com/400/400/transport/' . mt_rand(0, 99) . '/')
                    ->setExtension('jpg')
                    ->setSize($faker->numberBetween(1, 1000));
            
            $manager->persist($picture);
            
            $this->addReference('picture_vehicle_'. $index, $picture);
        }
        
        $manager->flush();
    }
        
}
