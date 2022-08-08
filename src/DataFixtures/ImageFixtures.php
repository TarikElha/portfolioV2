<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    const IMAGES = ['build/images/clients/wcs.png',
                    'build/images/Hackaton1/hackaton1_1.png',
                    'build/images/Projet2/projet2_1.png',
                    'build/images/Projet3/QC.png',
                    'build/images/clients/gaea21.jpg',
                    'build/images/clients/manomano.jpg',
                    'https://placekitten.com/321/520',
                    'https://placeimg.com/218/73/any',
                    'https://placekitten.com/589/266',
                    'https://placekitten.com/389/132',
                    'https://placeimg.com/366/471/any',
                    'https://placekitten.com/623/327',
                    'https://placeimg.com/347/101/any',
                    'https://placekitten.com/817/318',
                ];

    public function load(ObjectManager $manager)

    {
        foreach(self::IMAGES as $key => $imageUrl) {
            $image = new Image();
            $image->setUrl($imageUrl);
            $manager->persist($image);
            $this->addReference('image_' . $key, $image);
        }

        $manager->flush();
    }
}
