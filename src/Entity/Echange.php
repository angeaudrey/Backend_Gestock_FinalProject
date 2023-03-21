<?php

namespace App\Entity;

use App\Repository\EchangeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EchangeRepository::class)]
class Echange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datechange = null;

    #[ORM\ManyToOne(inversedBy: 'echangesquidemande')]
    private ?User $userquidemande = null;

    #[ORM\ManyToOne(inversedBy: 'echangesquirecoit')]
    private ?User $userquirecoit = null;

    #[ORM\ManyToOne(inversedBy: 'echangesarticledemande')]
    private ?Articles $articledemande = null;

    #[ORM\ManyToOne(inversedBy: 'echangesarticlerecu')]
    private ?Articles $articlerecu = null;

    #[ORM\ManyToOne(inversedBy: 'echangesproposition')]
    private ?Proposition $identifiantproposition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatechange(): ?\DateTimeInterface
    {
        return $this->datechange;
    }

    public function setDatechange(?\DateTimeInterface $datechange): self
    {
        $this->datechange = $datechange;

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

    public function getUserquirecoit(): ?User
    {
        return $this->userquirecoit;
    }

    public function setUserquirecoit(?User $userquirecoit): self
    {
        $this->userquirecoit = $userquirecoit;

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

    public function getArticlerecu(): ?Articles
    {
        return $this->articlerecu;
    }

    public function setArticlerecu(?Articles $articlerecu): self
    {
        $this->articlerecu = $articlerecu;

        return $this;
    }

    public function getIdentifiantproposition(): ?Proposition
    {
        return $this->identifiantproposition;
    }

    public function setIdentifiantproposition(?Proposition $identifiantproposition): self
    {
        $this->identifiantproposition = $identifiantproposition;

        return $this;
    }
}
