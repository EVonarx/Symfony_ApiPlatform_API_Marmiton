<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recette"})
     */
    private $nomIngredient;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"recette"})
     */
    private $quantity;

    //, cascade={"persist"} => rajoute l'unite dans la table mysql !!!!!
    /**
     * @ORM\ManyToOne(targetEntity=Unite::class, inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"recette"})
     */
    private $unity;

    //, cascade={"persist"} => rajoute l'aliment dans la table mysql !!!!!
    /**
     * @ORM\ManyToOne(targetEntity=Aliment::class, inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"recette"})
     */
    private $aliment;

    /**
     * @ORM\ManyToMany(targetEntity=Recette::class, mappedBy="ingredient")
     */
    private $recettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomIngredient(): ?string
    {
        return $this->nomIngredient;
    }

    public function setNomIngredient(string $nomIngredient): self
    {
        $this->nomIngredient = $nomIngredient;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnity(): ?Unite
    {
        return $this->unity;
    }

    public function setUnity(?Unite $unity): self
    {
        $this->unity = $unity;

        return $this;
    }

    public function getAliment(): ?Aliment
    {
        return $this->aliment;
    }

    public function setAliment(?Aliment $aliment): self
    {
        $this->aliment = $aliment;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
            $recette->addIngredient($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->contains($recette)) {
            $this->recettes->removeElement($recette);
            $recette->removeIngredient($this);
        }

        return $this;
    }
}
