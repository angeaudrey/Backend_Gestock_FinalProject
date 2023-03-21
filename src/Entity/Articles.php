<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $designation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(nullable: true)]
    private ?bool $statut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datecreation = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'articledemande', targetEntity: Proposition::class)]
    private Collection $propositions;

    #[ORM\OneToMany(mappedBy: 'articlequirecoistrue', targetEntity: Proposition::class)]
    private Collection $propositionsarticlequirecois;

    #[ORM\OneToMany(mappedBy: 'articledemande', targetEntity: Echange::class)]
    private Collection $echangesarticledemande;

    #[ORM\OneToMany(mappedBy: 'articlerecu', targetEntity: Echange::class)]
    private Collection $echangesarticlerecu;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Category $categorie = null;

    #[ORM\Column(nullable: true)]
    private ?float $montantestimation = null;

    public function __construct()
    {
        $this->propositions = new ArrayCollection();
        $this->propositionsarticlequirecois = new ArrayCollection();
        $this->echangesarticledemande = new ArrayCollection();
        $this->echangesarticlerecu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(?bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $proposition->setArticledemande($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->removeElement($proposition)) {
            // set the owning side to null (unless already changed)
            if ($proposition->getArticledemande() === $this) {
                $proposition->setArticledemande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Proposition>
     */
    public function getPropositionsarticlequirecois(): Collection
    {
        return $this->propositionsarticlequirecois;
    }

    public function addPropositionsarticlequirecoi(Proposition $propositionsarticlequirecoi): self
    {
        if (!$this->propositionsarticlequirecois->contains($propositionsarticlequirecoi)) {
            $this->propositionsarticlequirecois->add($propositionsarticlequirecoi);
            $propositionsarticlequirecoi->setArticlequirecoistrue($this);
        }

        return $this;
    }

    public function removePropositionsarticlequirecoi(Proposition $propositionsarticlequirecoi): self
    {
        if ($this->propositionsarticlequirecois->removeElement($propositionsarticlequirecoi)) {
            // set the owning side to null (unless already changed)
            if ($propositionsarticlequirecoi->getArticlequirecoistrue() === $this) {
                $propositionsarticlequirecoi->setArticlequirecoistrue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Echange>
     */
    public function getEchangesarticledemande(): Collection
    {
        return $this->echangesarticledemande;
    }

    public function addEchangesarticledemande(Echange $echangesarticledemande): self
    {
        if (!$this->echangesarticledemande->contains($echangesarticledemande)) {
            $this->echangesarticledemande->add($echangesarticledemande);
            $echangesarticledemande->setArticledemande($this);
        }

        return $this;
    }

    public function removeEchangesarticledemande(Echange $echangesarticledemande): self
    {
        if ($this->echangesarticledemande->removeElement($echangesarticledemande)) {
            // set the owning side to null (unless already changed)
            if ($echangesarticledemande->getArticledemande() === $this) {
                $echangesarticledemande->setArticledemande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Echange>
     */
    public function getEchangesarticlerecu(): Collection
    {
        return $this->echangesarticlerecu;
    }

    public function addEchangesarticlerecu(Echange $echangesarticlerecu): self
    {
        if (!$this->echangesarticlerecu->contains($echangesarticlerecu)) {
            $this->echangesarticlerecu->add($echangesarticlerecu);
            $echangesarticlerecu->setArticlerecu($this);
        }

        return $this;
    }

    public function removeEchangesarticlerecu(Echange $echangesarticlerecu): self
    {
        if ($this->echangesarticlerecu->removeElement($echangesarticlerecu)) {
            // set the owning side to null (unless already changed)
            if ($echangesarticlerecu->getArticlerecu() === $this) {
                $echangesarticlerecu->setArticlerecu(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Category
    {
        return $this->categorie;
    }

    public function setCategorie(?Category $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getMontantestimation(): ?float
    {
        return $this->montantestimation;
    }

    public function setMontantestimation(?float $montantestimation): self
    {
        $this->montantestimation = $montantestimation;

        return $this;
    }
}
