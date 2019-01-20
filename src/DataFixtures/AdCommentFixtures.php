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
use App\Entity\AdComment;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class AdCommentFixtures extends Fixture implements DependentFixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');  
        
        for ($index = 1; $index < 11; $index++) {
            $adComment = new AdComment();
            $adComment->setUser($this->getReference('user_'. mt_rand(1, 30)))
                    ->setAd($this->getReference('ad_'. mt_rand(1, 10)))
                    ->setContent($faker->unique()->sentences(3, true));
            
            $manager->persist($adComment);
        }
        
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            AdFixtures::class,
        );
    }
}
