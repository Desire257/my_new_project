<?php

namespace App\Entity;

use App\Repository\CamionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CamionRepository::class)]
#[ORM\Table(name: "camions")]
class Camion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $plaque = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroChassis = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateMiseCirc = null;

    /**
     * @var Collection<int, Chauffeur>
     */
    #[ORM\OneToMany(targetEntity: Chauffeur::class, mappedBy: 'relation')]
    private Collection $chauffeurs;

    public function __construct()
    {
        $this->chauffeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPlaque(): ?string
    {
        return $this->plaque;
    }

    public function setPlaque(string $plaque): static
    {
        $this->plaque = $plaque;

        return $this;
    }

    public function getNumeroChassis(): ?string
    {
        return $this->numeroChassis;
    }

    public function setNumeroChassis(string $numeroChassis): static
    {
        $this->numeroChassis = $numeroChassis;

        return $this;
    }

    public function getDateMiseCirc(): ?\DateTimeInterface
    {
        return $this->DateMiseCirc;
    }

    public function setDateMiseCirc(\DateTimeInterface $DateMiseCirc): static
    {
        $this->DateMiseCirc = $DateMiseCirc;

        return $this;
    }

    /**
     * @return Collection<int, Chauffeur>
     */
    public function getChauffeurs(): Collection
    {
        return $this->chauffeurs;
    }

    public function addChauffeur(Chauffeur $chauffeur): static
    {
        if (!$this->chauffeurs->contains($chauffeur)) {
            $this->chauffeurs->add($chauffeur);
            $chauffeur->setRelation($this);
        }

        return $this;
    }

    public function removeChauffeur(Chauffeur $chauffeur): static
    {
        if ($this->chauffeurs->removeElement($chauffeur)) {
            // set the owning side to null (unless already changed)
            if ($chauffeur->getRelation() === $this) {
                $chauffeur->setRelation(null);
            }
        }

        return $this;
    }
}
