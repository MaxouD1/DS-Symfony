<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $realisateur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_sortie = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\OneToMany(mappedBy: 'films', targetEntity: Projection::class)]
    private Collection $projections;

    public function __construct()
    {
        $this->projections = new ArrayCollection();
    }

    #[ORM\OneToMany(mappedBy: 'films', targetEntity: Projection::class)]






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): static
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): static
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getProjection(): ?Projection
    {
        return $this->projection;
    }

    public function setProjection(?Projection $projection): static
    {
        $this->projection = $projection;

        return $this;
    }

    public function addProjection(Projection $projection): static
    {
        if (!$this->projection->contains($projection)) {
            $this->projection->add($projection);
            $projection->setFilm($this);
        }

        return $this;
    }

    public function removeProjection(Projection $projection): static
    {
        if ($this->projection->removeElement($projection)) {
            // set the owning side to null (unless already changed)
            if ($projection->getFilm() === $this) {
                $projection->setFilm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Projection>
     */
    public function getProjections(): Collection
    {
        return $this->projections;
    }


}
