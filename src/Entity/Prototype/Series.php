<?php
//
//namespace App\Entity\Prototype;
//
//use App\Repository\SeriesRepository;
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
//use Doctrine\ORM\Mapping as ORM;
//
//#[ORM\Entity(repositoryClass: SeriesRepository::class)]
//class Series
//{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;
//
//    #[ORM\Column]
//    private ?string $Name = null;
//
//    #[ORM\ManyToMany(targetEntity: EntertainmentProduct::class, mappedBy: 'Series')]
//    private Collection $entertainmentProducts;
//
//    #[ORM\OneToMany(mappedBy: 'series', targetEntity: Genries::class)]
//    private Collection $genries;
//
//    public function __construct()
//    {
//        $this->entertainmentProducts = new ArrayCollection();
//        $this->genries = new ArrayCollection();
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
//    public function addEntertainmentProduct(EntertainmentProduct $entertainmentProduct): static
//    {
//        if (!$this->entertainmentProducts->contains($entertainmentProduct)) {
//            $this->entertainmentProducts->add($entertainmentProduct);
//            $entertainmentProduct->addSeries($this);
//        }
//
//        return $this;
//    }
//
//    public function removeEntertainmentProduct(EntertainmentProduct $entertainmentProduct): static
//    {
//        if ($this->entertainmentProducts->removeElement($entertainmentProduct)) {
//            $entertainmentProduct->removeSeries($this);
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
//        return $this->genries;
//    }
//
//    public function addGenry(Genries $genry): static
//    {
//        if (!$this->genries->contains($genry)) {
//            $this->genries->add($genry);
//            $genry->setSeries($this);
//        }
//
//        return $this;
//    }
//
//    public function removeGenry(Genries $genry): static
//    {
//        if ($this->genries->removeElement($genry)) {
//            // set the owning side to null (unless already changed)
//            if ($genry->getSeries() === $this) {
//                $genry->setSeries(null);
//            }
//        }
//
//        return $this;
//    }
//}
