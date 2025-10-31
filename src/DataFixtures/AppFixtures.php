<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Image;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr-FR');

        for($i = 0; $i <= 30; $i++)
        { 
            $ad = new Ad();

            $title = $faker->sentence();
            $coverImage = $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            
            // Paragraphes : on s'assure toujours d'avoir un array
            $paragraphs = $faker->paragraphs(5);
            if(!is_array($paragraphs))
            {
                $paragraphs = [$paragraphs];
            }

            // Construction du contenu HTML
            $content = '<p>' . implode('</p><p>', $paragraphs) . '</p>';

            $price = $faker->numberBetween(40, 200);
            $rooms = $faker->numberBetween(1, 5);

            $ad->setTitle($title)
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1, 5));

            for($j = 1; $j < mt_rand(2, 5); $j++)
            { 
                $image = new Image();
                $image->setUrl($faker->imageUrl())
                      ->setCaption($faker->sentence())
                      ->setAd($ad);
                
                $manager->persist($image);
            }

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
