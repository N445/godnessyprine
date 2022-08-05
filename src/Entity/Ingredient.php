<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int       $id    = null;

    #[ORM\Column(length: 255)]
    private ?string    $title = null;

    #[ORM\ManyToMany(targetEntity: Sirop::class, mappedBy: 'ingredients')]
    private Collection $sirops;

    public function __construct()
    {
        $this->sirops = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title;
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

    /**
     * @return Collection<int, Sirop>
     */
    public function getSirops(): Collection
    {
        return $this->sirops;
    }

    public function addSirop(Sirop $sirop): self
    {
        if (!$this->sirops->contains($sirop)) {
            $this->sirops->add($sirop);
            $sirop->addIngredient($this);
        }

        return $this;
    }

    public function removeSirop(Sirop $sirop): self
    {
        if ($this->sirops->removeElement($sirop)) {
            $sirop->removeIngredient($this);
        }

        return $this;
    }
}
