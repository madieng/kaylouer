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
use App\Entity\Ad;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class AdFixtures extends Fixture implements DependentFixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');  
        
        for ($index = 1; $index < 16; $index++) {
            $ad = new Ad();
            $date = $faker->unique()->dateTimeBetween('-10 days','+10 days');
            $ad->setDescription($faker->unique()->paragraph(3, true))
                ->setAppointmentAt($date)
                ->setAppointmentAddress($faker->unique()->address)
                ->addJourney($this->getReference('responded_journey_'. $index))
                ->setDriver($this->getReference('driver_'. mt_rand(1, 10)));
            
            $manager->persist($ad);
            
            $this->addReference('responded_ad_'. $index, $ad);
            $this->addReference('ad_'. $index, $ad);
        }
        
        for ($index = 1; $index < 6; $index++) {
            $ad = new Ad();
            $date = $faker->unique()->dateTimeBetween('-10 days','+10 days');
            $ad->setDescription($faker->unique()->paragraph(3, true))
                ->setAppointmentAt($date)
                ->setAppointmentAddress($faker->unique()->address)
                ->addJourney($this->getReference('creation_journey_'. mt_rand(1, 5)));
            
            $manager->persist($ad);
            
            $this->addReference('creation_ad_'. $index, $ad);
            $adIndex = $index + 15;
            $this->addReference('ad_'. $adIndex, $ad);
        }
        
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            JourneyFixtures::class,
            UserFixtures::class,
        );
    }
}
