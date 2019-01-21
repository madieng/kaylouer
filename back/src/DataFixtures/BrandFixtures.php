<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BrandFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');             
        
        for ($index = 1; $index <= 20; $index++) {
            $brand = new Brand();
            
            $brand->setLabel($faker->unique()->word);
            
            $manager->persist($brand);
            
            $this->addReference('brand_'. $index, $brand);
        }
        
        $manager->flush();
    }
}