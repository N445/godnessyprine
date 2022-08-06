<?php

namespace App\Entity;

use App\Repository\SiropRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SiropRepository::class)]
#[UniqueEntity('urlSlug')]
class Sirop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int                $id          = null;

    #[ORM\Column(length: 255)]
    private ?string             $title       = null;

    #[ORM\Column]
    private ?int                $price       = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string             $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string             $ingredients = null;

    #[ORM\OneToMany(mappedBy: 'sirop', targetEntity: SiropImage::class, cascade: ['persist', 'remove'])]
    private Collection          $images;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt   = null;

    #[ORM\Column(length: 255)]
    private ?string             $urlSlug     = null;

    #[ORM\Column]
    private ?int $displayOrder = null;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->images      = new ArrayCollection();
        $this->createdAt   = new \DateTimeImmutable('NOW');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    /**
     * @return string|null
     */
    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    /**
     * @param string|null $ingredients
     * @return Sirop
     */
    public function setIngredients(?string $ingredients): Sirop
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * @return Collection<int, SiropImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(SiropImage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setSirop($this);
        }

        return $this;
    }

    public function removeImage(SiropImage $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getSirop() === $this) {
                $image->setSirop(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUrlSlug(): ?string
    {
        return $this->urlSlug;
    }

    public function setUrlSlug(string $urlSlug): self
    {
        $this->urlSlug = $urlSlug;

        return $this;
    }

    public function getDisplayOrder(): ?int
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder(int $displayOrder): self
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }
}
