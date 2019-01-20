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
use App\Entity\Journey;
use App\Entity\StatusJourney;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class JourneyFixtures extends Fixture implements DependentFixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR'); 
        
        $statutes = [
            //StatusJourney::CREATION,
            StatusJourney::RESPONDED,
            StatusJourney::ON_THE_WAY,
            StatusJourney::DONE
        ];
        
        //favorite
        for ($index = 1; $index < 21; $index++) {
            $favoriteJourney = new Journey();
            $favoriteJourney->setStatusJourney($this->getReference('status_'. StatusJourney::CREATION))
                    ->setDepatureAddress($this->getReference('address_departure_'. mt_rand(1, 10)))
                    ->setArrivalAddress($this->getReference('address_arrival_'. mt_rand(1, 10)));
            
            $manager->persist($favoriteJourney);
            
            $this->addReference('favorite_journey_'. $index, $favoriteJourney);
        }
        
        //random journey
        for ($index = 1; $index < 16; $index++) {
            $journey = new Journey();
            $journey->setStatusJourney($this->getReference('status_'.$faker->randomElement($statutes)))
                    ->setDepatureAddress($this->getReference('address_departure_'. mt_rand(1, 10)))
                    ->setArrivalAddress($this->getReference('address_arrival_'. mt_rand(1, 10)));
            
            $manager->persist($journey);
            
            $this->addReference('responded_journey_'. $index, $journey);
        }
        
        //creation
        for ($index = 1; $index < 6; $index++) {
            $journey = new Journey();
            $journey->setStatusJourney($this->getReference('status_'. StatusJourney::CREATION))
                    ->setDepatureAddress($this->getReference('address_departure_'. mt_rand(1, 10)))
                    ->setArrivalAddress($this->getReference('address_arrival_'. mt_rand(1, 10)));
            
            $manager->persist($journey);
            
            $this->addReference('creation_journey_'. $index, $journey);
        }
        
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            AddressFixtures::class,
            StatusJourneyFixtures::class,
        );
    }
}
