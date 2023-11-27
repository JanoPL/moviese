<?php
//
//namespace App\Entity\Prototype;
//
//use App\Repository\EntertaimentProductRepository;
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
//use Doctrine\ORM\Mapping as ORM;
//
//#[ORM\Entity(repositoryClass: EntertaimentProductRepository::class)]
//class EntertainmentProduct
//{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;
//
//    #[ORM\ManyToMany(targetEntity: Movie::class, inversedBy: 'entertainmentProducts', cascade: ["persist"])]
//    private Collection $movies;
//
//    #[ORM\ManyToMany(targetEntity: Series::class, inversedBy: 'entertainmentProducts', cascade: ["persist"])]
//    private Collection $Series;
//
//    #[ORM\Column(length: 128)]
//    private ?string $Name = null;
//
//    public function __construct()
//    {
//        $this->movies = new ArrayCollection();
//        $this->Series = new ArrayCollection();
//    }
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return Collection<int, Movie>
//     */
//    public function getMovies(): Collection
//    {
//        return $this->movies;
//    }
//
//    public function addMovie(Movie $movie): static
//    {
//        if (!$this->movies->contains($movie)) {
//            $this->movies->add($movie);
//        }
//
//        return $this;
//    }
//
//    public function removeMovie(Movie $movie): static
//    {
//        $this->movies->removeElement($movie);
//
//        return $this;
//    }
//
//    /**
//     * @return Collection<int, Series>
//     */
//    public function getSeries(): Collection
//    {
//        return $this->Series;
//    }
//
//    public function addSeries(Series $series): static
//    {
//        if (!$this->Series->contains($series)) {
//            $this->Series->add($series);
//        }
//
//        return $this;
//    }
//
//    public function removeSeries(Series $series): static
//    {
//        $this->Series->removeElement($series);
//
//        return $this;
//    }
//
//    public function getName(): ?string
//    {
//        return $this->Name;
//    }
//
//    public function setName(string $Name): static
//    {
//        $this->Name = $Name;
//
//        return $this;
//    }
//}
