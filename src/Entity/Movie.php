<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genries $genry = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genries $Genre = null;

    #[ORM\ManyToMany(targetEntity: EntertainmentProduct::class, mappedBy: 'movies')]
    private Collection $entertaimentProducts;

    public function __construct()
    {
        $this->entertaimentProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getGenry(): ?Genries
    {
        return $this->genry;
    }

    public function setGenry(?Genries $genry): static
    {
        $this->genry = $genry;

        return $this;
    }

    public function getGenre(): ?Genries
    {
        return $this->Genre;
    }

    public function setGenre(?Genries $Genre): static
    {
        $this->Genre = $Genre;

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
            $entertaimentProduct->addMovie($this);
        }

        return $this;
    }

    public function removeEntertaimentProduct(EntertainmentProduct $entertaimentProduct): static
    {
        if ($this->entertaimentProducts->removeElement($entertaimentProduct)) {
            $entertaimentProduct->removeMovie($this);
        }

        return $this;
    }
}
