<?php
//
//namespace App\Entity\Prototype;
//
//use App\Repository\MovieRepository;
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
//use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;
//
//#[ORM\Entity(repositoryClass: MovieRepository::class)]
//class Movie
//{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;
//
//    #[ORM\Column(length: 255)]
//    #[Assert\NotBlank]
//    #[Assert\Length(
//        min: 2,
//        max: 255,
//        minMessage: 'Your first name must be at least {{ limit }} characters long',
//        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
//    )]
//    private ?string $Name = null;
//
//    #[ORM\ManyToMany(targetEntity: EntertainmentProduct::class, mappedBy: 'movies')]
//    private Collection $entertainmentProducts;
//
//    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: Genries::class)]
//    private Collection $Genries;
//
//    public function __construct()
//    {
//        $this->entertainmentProducts = new ArrayCollection();
//        $this->Genries = new ArrayCollection();
//    }
//
//    public function getId(): ?int
//    {
//        return $this->id;
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
//
//    /**
//     * @return Collection<int, EntertainmentProduct>
//     */
//    public function getEntertainmentProducts(): Collection
//    {
//        return $this->entertainmentProducts;
//    }
//
//    public function addEntertainmentProduct(EntertainmentProduct $entertaimentProduct): static
//    {
//        if (!$this->entertainmentProducts->contains($entertaimentProduct)) {
//            $this->entertainmentProducts->add($entertaimentProduct);
//            $entertaimentProduct->addMovie($this);
//        }
//
//        return $this;
//    }
//
//    public function removeEntertainmentProduct(EntertainmentProduct $entertaimentProduct): static
//    {
//        if ($this->entertainmentProducts->removeElement($entertaimentProduct)) {
//            $entertaimentProduct->removeMovie($this);
//        }
//
//        return $this;
//    }
//
//    /**
//     * @return Collection<int, Genries>
//     */
//    public function getGenries(): Collection
//    {
//        return $this->Genries;
//    }
//
//    public function addGenry(Genries $genry): static
//    {
//        if (!$this->Genries->contains($genry)) {
//            $this->Genries->add($genry);
//            $genry->setMovie($this);
//        }
//
//        return $this;
//    }
//
//    public function removeGenry(Genries $genry): static
//    {
//        if ($this->Genries->removeElement($genry)) {
//            // set the owning side to null (unless already changed)
//            if ($genry->getMovie() === $this) {
//                $genry->setMovie(null);
//            }
//        }
//
//        return $this;
//    }
//}
