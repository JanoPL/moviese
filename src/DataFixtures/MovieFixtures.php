<?php

namespace App\DataFixtures;

use App\Entity\EntertainmentProduct;
use App\Entity\Movie;
use App\Entity\Series;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $file = file_get_contents(__DIR__ . '/data/MoviesSeries.json');

        foreach (json_decode($file) as $item) {

            if ($item->Type == 'movie') {
                $movie = new Movie();
                $this->createItem($item, $movie, $manager);
            }

            if ($item->Type == 'series') {
                $series = new Series();
                $this->createItem($item, $series, $manager);
            }
        }

        $manager->flush();
    }

    private function createItem($item, Movie|Series $object, $manager) {
        $object->setName($item->Title);
        $object->setType($item->Type);

        if ($object instanceof Movie) {
            $object->setGenre($item->Genre);
        }

        if ($object instanceof Series) {
            $object->setSeasonNumber($item->totalSeasons);
        }

        $manager->persist($object);
    }
}
