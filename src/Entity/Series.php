<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Series extends EntertainmentProduct
{
    #[ORM\Column]
    private ?int $seasonNumber;

    public function setSeasonNumber(?int $seasonNumber): Series
    {
        $this->seasonNumber = $seasonNumber;
        return $this;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->seasonNumber;
    }
}