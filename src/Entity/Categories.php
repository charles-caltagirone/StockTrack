<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Produits::class, mappedBy: 'id_category')]
    private Collection $id_category;

    public function __construct()
    {
        $this->id_category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getIdCategory(): Collection
    {
        return $this->id_category;
    }

    public function addIdCategory(Produits $idCategory): static
    {
        if (!$this->id_category->contains($idCategory)) {
            $this->id_category->add($idCategory);
            $idCategory->addIdCategory($this);
        }

        return $this;
    }

    public function removeIdCategory(Produits $idCategory): static
    {
        if ($this->id_category->removeElement($idCategory)) {
            $idCategory->removeIdCategory($this);
        }

        return $this;
    }
}
