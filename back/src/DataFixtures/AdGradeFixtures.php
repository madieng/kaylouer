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
use App\Entity\AdGrade;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class AdGradeFixtures extends Fixture implements DependentFixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');  
        
        for ($index = 1; $index < 11; $index++) {
            $adGrade = new AdGrade();
            $adGrade->setAd($this->getReference('responded_ad_'. mt_rand(1, 10)))
                    ->setCustomer($this->getReference('customer_'. mt_rand(1, 20)));
            
            $isGrade = mt_rand(0, 1);
            if($isGrade) {
                $adGrade->setGrade(mt_rand(1, 5))
                        ->setGradedAt(new \Datetime());
            }
            
            $manager->persist($adGrade);
            
            //$this->addReference('town_'. $index, $adGrade);
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
