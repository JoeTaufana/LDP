<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $article;

    #[ORM\OneToMany(targetEntity: Evenement::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $evenement;

    #[ORM\OneToMany(targetEntity: Membre::class, mappedBy: 'createur')]
    private Collection $membre;

    #[ORM\OneToMany(targetEntity: Coordonnee::class, mappedBy: 'createur')]
    private Collection $coordonnee;

    #[ORM\ManyToMany(targetEntity: Evenement::class, mappedBy: 'Participant')]
    private Collection $evenements;

    #[ORM\ManyToMany(targetEntity: Evenement::class, mappedBy: 'Participant')]
    private Collection $Participants; // Événements auxquels l'utilisateur participe

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->evenement = new ArrayCollection();
        $this->membre = new ArrayCollection();
        $this->coordonnee = new ArrayCollection();
        $this->evenements = new ArrayCollection();
        $this->Participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->article->contains($article)) {
            $this->article->add($article);
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenement(): Collection
    {
        return $this->evenement;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenement->contains($evenement)) {
            $this->evenement->add($evenement);
            $evenement->setCreateur($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenement->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getCreateur() === $this) {
                $evenement->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getMembre(): Collection
    {
        return $this->membre;
    }

    public function addMembre(Membre $membre): static
    {
        if (!$this->membre->contains($membre)) {
            $this->membre->add($membre);
            $membre->setCreateur($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): static
    {
        if ($this->membre->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getCreateur() === $this) {
                $membre->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Coordonnee>
     */
    public function getCoordonnee(): Collection
    {
        return $this->coordonnee;
    }

    public function addContact(Coordonnee $contact): static
    {
        if (!$this->coordonnee->contains($contact)) {
            $this->coordonnee->add($contact);
            $contact->setCreateur($this);
        }

        return $this;
    }

    public function removeContact(Coordonnee $contact): static
    {
        if ($this->coordonnee->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getCreateur() === $this) {
                $contact->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getParticipants(): Collection
    {
        return $this->Participants;
    }

    public function addParticipant(Evenement $participant): static
    {
        if (!$this->Participants->contains($participant)) {
            $this->Participants->add($participant);
            $participant->addParticipant($this);
        }

        return $this;
    }

    public function removeParticipant(Evenement $participant): static
    {
        if ($this->Participants->removeElement($participant)) {
            $participant->removeParticipant($this);
        }

        return $this;
    }
}
