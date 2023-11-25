<?php

namespace App\Entity;

use App\Repository\SeriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeriesRepository::class)]
class Series
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Name = null;

    #[ORM\ManyToOne(inversedBy: 'series')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genries $genre = null;

    #[ORM\ManyToMany(targetEntity: EntertainmentProduct::class, mappedBy: 'Series')]
    private Collection $entertaimentProducts;

    public function __construct()
    {
        $this->entertaimentProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->Name;
    }

    public function setName(int $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getGenre(): ?Genries
    {
        return $this->genre;
    }

    public function setGenre(?Genries $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, EntertainmentProduct>
     */
    public function getEntertaimentProducts(): Collection
    {
        return $this->entertaimentProducts;
    }

    public function addEntertaimentProduct(EntertainmentProduct $entertaimentProduct): static
    {
        if (!$this->entertaimentProducts->contains($entertaimentProduct)) {
            $this->entertaimentProducts->add($entertaimentProduct);
            $entertaimentProduct->addSeries($this);
        }

        return $this;
    }

    public function removeEntertaimentProduct(EntertainmentProduct $entertaimentProduct): static
    {
        if ($this->entertaimentProducts->removeElement($entertaimentProduct)) {
            $entertaimentProduct->removeSeries($this);
        }

        return $this;
    }
}
