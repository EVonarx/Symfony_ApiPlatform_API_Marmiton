<?php

namespace App\Entity;
use App\Entity\Price;

use App\Repository\RecetteRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

//formats={},
/**
 * @ApiResource(
 *     normalizationContext={"groups"={"recette"}},
 *     denormalizationContext={"groups"={"recette"}},
 * )
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"recette"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recette"})
     */
    private $nomrecette;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"recette"})
     */
    private $nombrepersonne;

    /**
     * 
     * @ORM\Column(type="boolean")
     * @Groups({"recette"})
     */
    private $isvalide;

    /**
     * @ORM\Column(type="time")
     * @Groups({"recette"})
     */
    private $temps;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recette"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, mappedBy="recette", cascade={"persist"})
     * @Groups({"recette"})
     */
    private $categories;

    /**
     * @ORM\Column(type="array")
     * @Groups({"recette"})
     */
    private $etapes = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"recette"})
     */
    private $images = [];

    /**
     * @ORM\ManyToOne(targetEntity=Price::class, inversedBy="recette")
     * @Groups({"recette"})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Difficulte::class, inversedBy="recette")
     * @Groups({"recette"})
     */
    private $difficulte;
    
    //, cascade={"persist"} => rajoute une entrée dans la table mysql !!!!!
    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="recettes")
     * @Groups({"recette"})
     */
    private $ingredient;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->unite = new ArrayCollection();
        $this->ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRecette(): ?string
    {
        return $this->nomrecette;
    }

    public function setNomRecette(string $nomrecette): self
    {
        $this->nomrecette = $nomrecette;

        return $this;
    }

    public function getNombrePersonne(): ?int
    {
        return $this->nombrepersonne;
    }

    public function setNombrePersonne(int $nombrepersonne): self
    {
        $this->nombrepersonne = $nombrepersonne;

        return $this;
    }

    public function getIsValide(): ?bool
    {
        return $this->isvalide;
    }

    public function setIsValide(bool $isvalide): self
    {
        $this->isvalide = $isvalide;

        return $this;
    }

    public function getTemps(): ?\DateTimeInterface
    {
        return $this->temps;
    }

    public function setTemps(\DateTimeInterface $temps): self
    {
        $this->temps = $temps;

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

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addRecette($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeRecette($this);
        }

        return $this;
    }

    public function getEtapes(): ?array
    {
        return $this->etapes;
    }

    public function setEtapes(array $etapes): self
    {
        $this->etapes = $etapes;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function setPrice(?Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDifficulte(): ?Difficulte
    {
        return $this->difficulte;
    }

    public function setDifficulte(?Difficulte $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredient->contains($ingredient)) {
            $this->ingredient->removeElement($ingredient);
        }

        return $this;
    }

}
