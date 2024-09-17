<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $rdv = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'evenement')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'participation')]
    #[ORM\JoinTable(name: 'user_evenement')]
    private Collection $participant;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null; 

    public function __construct() {
        $this->participant = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRdv(): ?\DateTimeInterface
    {
        return $this->rdv;
    }

    public function setRdv(\DateTimeInterface $rdv): static
    {
        $this->rdv = $rdv;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(User $user): static
    {
        if (!$this->participant->contains($user)) {
            $this->participant->add($user);
            $user->addParticipation($this);
        }

        return $this;
    }
    public function removeParticipant(User $user): static
    {
        if ($this->participant->removeElement($user)) {
            $user->removeParticipation($this);
        }

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

}
