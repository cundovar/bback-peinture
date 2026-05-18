<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
#[ORM\Table(name: 'prefix_theme')]
#[ApiResource(
    normalizationContext: ['groups' => ['theme:read']],
    denormalizationContext: ['groups' => ['theme:write']],
)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['theme:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['theme:read', 'theme:write'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: Oeuvre::class)]
    private Collection $oeuvres;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? 'Theme';
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }
}
