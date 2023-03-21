<?php

namespace App\Entity;

use App\Repository\PropositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropositionRepository::class)]
class Proposition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $messsage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateproposition = null;

    #[ORM\Column(length: 255)]
    private ?string $etatproposition = null;

    #[ORM\ManyToOne(inversedBy: 'propositions')]
    private ?User $userquidemande = null;

    #[ORM\ManyToOne(inversedBy: 'propositionquirecois')]
    private ?User $userquirecois = null;

    #[ORM\ManyToOne(inversedBy: 'propositions')]
    private ?Articles $articledemande = null;

    #[ORM\ManyToOne(inversedBy: 'propositions')]
    private ?Articles $articlequirecois = null;

    #[ORM\ManyToOne(inversedBy: 'propositionsarticlequirecois')]
    private ?Articles $articlequirecoistrue = null;

    #[ORM\OneToMany(mappedBy: 'identifiantproposition', targetEntity: Echange::class)]
    private Collection $echangesproposition;

    public function __construct()
    {
        $this->echangesproposition = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMesssage(): ?string
    {
        return $this->messsage;
    }

    public function setMesssage(string $messsage): self
    {
        $this->messsage = $messsage;

        return $this;
    }

    public function getDateproposition(): ?\DateTimeInterface
    {
        return $this->dateproposition;
    }

    public function setDateproposition(?\DateTimeInterface $dateproposition): self
    {
        $this->dateproposition = $dateproposition;

        return $this;
    }

    public function getEtatproposition(): ?string
    {
        return $this->etatproposition;
    }

    public function setEtatproposition(string $etatproposition): self
    {
        $this->etatproposition = $etatproposition;

        return $this;
    }

    public function getUserquidemande(): ?User
    {
        return $this->userquidemande;
    }

    public function setUserquidemande(?User $userquidemande): self
    {
        $this->userquidemande = $userquidemande;

        return $this;
    }

    public function getUserquirecois(): ?User
    {
        return $this->userquirecois;
    }

    public function setUserquirecois(?User $userquirecois): self
    {
        $this->userquirecois = $userquirecois;

        return $this;
    }

    public function getArticledemande(): ?Articles
    {
        return $this->articledemande;
    }

    public function setArticledemande(?Articles $articledemande): self
    {
        $this->articledemande = $articledemande;

        return $this;
    }

    public function getArticlequirecois(): ?Articles
    {
        return $this->articlequirecois;
    }

    public function setArticlequirecois(?Articles $articlequirecois): self
    {
        $this->articlequirecois = $articlequirecois;

        return $this;
    }

    public function getArticlequirecoistrue(): ?Articles
    {
        return $this->articlequirecoistrue;
    }

    public function setArticlequirecoistrue(?Articles $articlequirecoistrue): self
    {
        $this->articlequirecoistrue = $articlequirecoistrue;

        return $this;
    }

    /**
     * @return Collection<int, Echange>
     */
    public function getEchangesproposition(): Collection
    {
        return $this->echangesproposition;
    }

    public function addEchangesproposition(Echange $echangesproposition): self
    {
        if (!$this->echangesproposition->contains($echangesproposition)) {
            $this->echangesproposition->add($echangesproposition);
            $echangesproposition->setIdentifiantproposition($this);
        }

        return $this;
    }

    public function removeEchangesproposition(Echange $echangesproposition): self
    {
        if ($this->echangesproposition->removeElement($echangesproposition)) {
            // set the owning side to null (unless already changed)
            if ($echangesproposition->getIdentifiantproposition() === $this) {
                $echangesproposition->setIdentifiantproposition(null);
            }
        }

        return $this;
    }
}
