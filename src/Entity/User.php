<?php

namespace App\Entity;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone_number = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Articles::class)]
    private Collection $articles;

    #[ORM\OneToMany(mappedBy: 'userquidemande', targetEntity: Proposition::class)]
    private Collection $propositions;

    #[ORM\OneToMany(mappedBy: 'userquirecois', targetEntity: Proposition::class)]
    private Collection $propositionquirecois;

    #[ORM\OneToMany(mappedBy: 'userquidemande', targetEntity: Echange::class)]
    private Collection $echangesquidemande;

    #[ORM\OneToMany(mappedBy: 'userquirecoit', targetEntity: Echange::class)]
    private Collection $echangesquirecoit;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->propositions = new ArrayCollection();
        $this->propositionquirecois = new ArrayCollection();
        $this->echangesquidemande = new ArrayCollection();
        $this->echangesquirecoit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Proposition>
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposition $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions->add($proposition);
            $proposition->setUserquidemande($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->removeElement($proposition)) {
            // set the owning side to null (unless already changed)
            if ($proposition->getUserquidemande() === $this) {
                $proposition->setUserquidemande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Proposition>
     */
    public function getPropositionquirecois(): Collection
    {
        return $this->propositionquirecois;
    }

    public function addPropositionquirecoi(Proposition $propositionquirecoi): self
    {
        if (!$this->propositionquirecois->contains($propositionquirecoi)) {
            $this->propositionquirecois->add($propositionquirecoi);
            $propositionquirecoi->setUserquirecois($this);
        }

        return $this;
    }

    public function removePropositionquirecoi(Proposition $propositionquirecoi): self
    {
        if ($this->propositionquirecois->removeElement($propositionquirecoi)) {
            // set the owning side to null (unless already changed)
            if ($propositionquirecoi->getUserquirecois() === $this) {
                $propositionquirecoi->setUserquirecois(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Echange>
     */
    public function getEchangesquidemande(): Collection
    {
        return $this->echangesquidemande;
    }

    public function addEchangesquidemande(Echange $echangesquidemande): self
    {
        if (!$this->echangesquidemande->contains($echangesquidemande)) {
            $this->echangesquidemande->add($echangesquidemande);
            $echangesquidemande->setUserquidemande($this);
        }

        return $this;
    }

    public function removeEchangesquidemande(Echange $echangesquidemande): self
    {
        if ($this->echangesquidemande->removeElement($echangesquidemande)) {
            // set the owning side to null (unless already changed)
            if ($echangesquidemande->getUserquidemande() === $this) {
                $echangesquidemande->setUserquidemande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Echange>
     */
    public function getEchangesquirecoit(): Collection
    {
        return $this->echangesquirecoit;
    }

    public function addEchangesquirecoit(Echange $echangesquirecoit): self
    {
        if (!$this->echangesquirecoit->contains($echangesquirecoit)) {
            $this->echangesquirecoit->add($echangesquirecoit);
            $echangesquirecoit->setUserquirecoit($this);
        }

        return $this;
    }

    public function removeEchangesquirecoit(Echange $echangesquirecoit): self
    {
        if ($this->echangesquirecoit->removeElement($echangesquirecoit)) {
            // set the owning side to null (unless already changed)
            if ($echangesquirecoit->getUserquirecoit() === $this) {
                $echangesquirecoit->setUserquirecoit(null);
            }
        }

        return $this;
    }
}
