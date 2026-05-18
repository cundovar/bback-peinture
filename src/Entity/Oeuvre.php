<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Api\LikeOeuvreController;
use App\Controller\Api\PopularOeuvresController;
use App\Controller\Api\UnlikeOeuvreController;
use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
#[ORM\Table(name: 'prefix_oeuvre')]
#[ApiResource(
    normalizationContext: ['groups' => ['oeuvre:read']],
    denormalizationContext: ['groups' => ['oeuvre:write']],
    operations: [
        new Get(requirements: ['id' => '\d+']),
        new GetCollection(),
        new GetCollection(
            uriTemplate: '/oeuvres/popular',
            controller: PopularOeuvresController::class,
            name: 'oeuvres_popular',
        ),
        new Post(),
        new Put(requirements: ['id' => '\d+']),
        new Delete(requirements: ['id' => '\d+']),
        new Post(
            uriTemplate: '/oeuvres/{id}/like',
            controller: LikeOeuvreController::class,
            input: false,
            output: false,
            name: 'oeuvre_like',
            requirements: ['id' => '\d+'],
        ),
        new Delete(
            uriTemplate: '/oeuvres/{id}/unlike',
            controller: UnlikeOeuvreController::class,
            input: false,
            output: false,
            name: 'oeuvre_unlike',
            requirements: ['id' => '\d+'],
        ),
    ],
)]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['oeuvre:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['oeuvre:read', 'oeuvre:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['oeuvre:read', 'oeuvre:write'])]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['oeuvre:read', 'oeuvre:write'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(name: 'categorie_id', referencedColumnName: 'id', nullable: true)]
    #[Groups(['oeuvre:read', 'oeuvre:write'])]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(name: 'theme_id', referencedColumnName: 'id', nullable: true)]
    #[Groups(['oeuvre:read', 'oeuvre:write'])]
    private ?Theme $theme = null;

    /**
     * @var Collection<int, Like>
     */
    #[ORM\OneToMany(mappedBy: 'oeuvre', targetEntity: Like::class, orphanRemoval: true)]
    #[Groups(['oeuvre:read'])]
    private Collection $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? 'Oeuvre';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setOeuvre($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like) && $like->getOeuvre() === $this) {
            $like->setOeuvre(null);
        }

        return $this;
    }

    #[Groups(['oeuvre:read'])]
    public function getLikesCount(): int
    {
        return $this->likes->count();
    }
}
