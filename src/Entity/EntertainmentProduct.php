<?php

namespace App\Entity;

use App\Repository\EntertainmentProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity(repositoryClass: EntertainmentProductRepository::class),
    ORM\InheritanceType("SINGLE_TABLE"),
    ORM\DiscriminatorMap(["movie" => Movie::class, 'series' => Series::class]),
    ORM\DiscriminatorColumn(name: 'discr', type: 'string')
]
class EntertainmentProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    #[Assert\Length(min: 3)]
    private ?string $name = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
