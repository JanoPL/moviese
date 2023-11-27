<?php
//
//namespace App\Entity\Prototype;
//
//use App\Repository\GenriesRepository;
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
//use Doctrine\ORM\Mapping as ORM;
//
//#[ORM\Entity(repositoryClass: GenriesRepository::class)]
//class Genries
//{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;
//
//    #[ORM\Column(length: 128)]
//    private ?string $name = null;
//
//    #[ORM\ManyToOne(inversedBy: 'Genries')]
//    #[ORM\JoinColumn(nullable: true)]
//    private ?Movie $movie = null;
//
//    #[ORM\ManyToOne(inversedBy: 'genries')]
//    #[ORM\JoinColumn(nullable: true)]
//    private ?Series $series = null;
//
//    public function __construct()
//    {
//    }
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }
//
//    public function getName(): ?string
//    {
//        return $this->name;
//    }
//
//    public function setName(string $name): static
//    {
//        $this->name = $name;
//
//        return $this;
//    }
//
//    public function getMovie(): ?Movie
//    {
//        return $this->movie;
//    }
//
//    public function setMovie(?Movie $movie): static
//    {
//        $this->movie = $movie;
//
//        return $this;
//    }
//
//    public function getSeries(): ?Series
//    {
//        return $this->series;
//    }
//
//    public function setSeries(?Series $series): static
//    {
//        $this->series = $series;
//
//        return $this;
//    }
//}
