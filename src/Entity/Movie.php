<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Movie extends EntertainmentProduct
{
    #[ORM\Column(length: 128)]
    private ?string $genre;

    public function setGenre(?string $genre): Movie
    {
        $this->genre = $genre;
        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }
}