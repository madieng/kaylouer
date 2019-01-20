<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\StatusJourney;

/**
 * Description of PictureFixtures
 *
 * @author franchesco971
 */
class StatusJourneyFixtures extends Fixture {
    
    public function load(ObjectManager $manager)
    {
        $statutes = [
            StatusJourney::CREATION => 'CREATION',
            StatusJourney::RESPONDED => 'RESPONDED',
            StatusJourney::ON_THE_WAY => 'ON_THE_WAY',
            StatusJourney::DONE => 'DONE'
        ];
                
        foreach ($statutes as $key => $status) {
            $statusJourney = new StatusJourney();
            $statusJourney->setLabel($status);
            
            $manager->persist($statusJourney);
            
            $this->addReference('status_'. $key, $statusJourney);
        }
        
        $manager->flush();
    }
        
}
