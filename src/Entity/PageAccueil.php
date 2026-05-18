<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PageAccueilRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: PageAccueilRepository::class)]
#[ORM\Table(name: 'prefix_page_accueil')]
#[ApiResource(
    normalizationContext: ['groups' => ['page_accueil:read']],
    denormalizationContext: ['groups' => ['page_accueil:write']],
)]
class PageAccueil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['page_accueil:read'])]
    private ?int $id = null;

    public function __toString(): string
    {
        return 'Page accueil #'.($this->id ?? 'nouvelle');
    }

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['page_accueil:read', 'page_accueil:write'])]
    private ?string $texte = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['page_accueil:read', 'page_accueil:write'])]
    private ?string $img1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['page_accueil:read', 'page_accueil:write'])]
    private ?string $img2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['page_accueil:read', 'page_accueil:write'])]
    private ?string $img3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['page_accueil:read', 'page_accueil:write'])]
    private ?string $img4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['page_accueil:read', 'page_accueil:write'])]
    private ?string $img5 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getImg1(): ?string
    {
        return $this->img1;
    }

    public function setImg1(?string $img1): self
    {
        $this->img1 = $img1;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img2;
    }

    public function setImg2(?string $img2): self
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img3;
    }

    public function setImg3(?string $img3): self
    {
        $this->img3 = $img3;

        return $this;
    }

    public function getImg4(): ?string
    {
        return $this->img4;
    }

        public function setImg4(?string $img4): self
    {
        $this->img4 = $img4;

        return $this;
    }

    public function getImg5(): ?string
    {
        return $this->img5;
    }

    public function setImg5(?string $img5): self
    {
        $this->img5 = $img5;

        return $this;
    }
}
