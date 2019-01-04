<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $categories = [];
        for ($i = 0; $i < 15; $i++) {
            $category = new Category();
            $category->setName(join(' ', $faker->words(mt_rand(1, 2))));
            $category->setCaption('https://picsum.photos/1585/600?image=' . mt_rand(0, 50));
            $category->setDescription(join(' ', $faker->sentences(mt_rand(3, 5))));
//            $category->setDescription('<p>' . join('</p><p>', $faker->sentences(mt_rand(3, 5))) . '</p>');

            $manager->persist($category);

            array_push($categories, $category);
        }

        for ($i = 0; $i < 100; $i++) {
            $product = new Product();

            $product->setName(join(' ', $faker->words(mt_rand(3, 6))));

            $product->setPrice(mt_rand(15, 50));
            $product->setQuantity(mt_rand(2, 10));
            $product->setCaption('https://picsum.photos/200/250/?image=' . mt_rand(0, 50));;
            $product->setDescription(join(' ', $faker->sentences(mt_rand(3, 5))));

            $product->addCategory($categories[mt_rand(0, count($categories) - 1)]);

            for ($j = 0; $j < mt_rand(2, 6); $j++) {
                $image = new Image();
                $image->setName(join(' ', $faker->words(mt_rand(3, 4))));
                $image->setUrl('https://picsum.photos/200/250/?image=' . mt_rand(0, 50));
                $image->setDescription('<p>' . join('</p><p>', $faker->sentences(mt_rand(3, 5))) . '</p>');
                $image->setProduct($product);

                $manager->persist($image);
            }


            $manager->persist($product);
        }


        $manager->flush();
    }
}
