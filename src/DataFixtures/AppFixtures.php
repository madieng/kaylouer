<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use App\Entity\Make;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $makes = [];
        for ($i = 0; $i < 15; $i++) {
            $make = new Make();
            $make->setName($faker->company());
            $make->setCaption('https://picsum.photos/1585/600?image=' . mt_rand(0, 50));
            $make->setDescription($faker->text(mt_rand(100, 200)));

            $manager->persist($make);

            array_push($makes, $make);
        }

        for ($i = 0; $i < 100; $i++) {
            $car = new Car();
            $car->setName(join(' ', $faker->words(mt_rand(3, 6))));
            $car->setPlaces(mt_rand(2, 7));
            $car->setCaption('https://picsum.photos/200/250/?image=' . mt_rand(0, 50));;
            $car->setDescription('<p>' . join('</p><p>', $faker->paragraphs(mt_rand(3, 5))) . '</p>');
            $car->setMake($makes[mt_rand(0, count($makes) - 1)]);

            for ($j = 0; $j < mt_rand(2, 6); $j++) {
                $image = new Image();
                $image->setName(join(' ', $faker->words(mt_rand(3, 4))));
                $image->setUrl('https://picsum.photos/200/250/?image=' . mt_rand(0, 50));
                $image->setDescription('<p>' . join('</p><p>', $faker->sentences(mt_rand(3, 5))) . '</p>');
                $image->setCar($car);

                $manager->persist($image);
            }


            $manager->persist($car);
        }


        $manager->flush();
    }
}
