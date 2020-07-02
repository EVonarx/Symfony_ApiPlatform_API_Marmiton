<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $commentaires = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaires(): ?array
    {
        return $this->commentaires;
    }

    public function setCommentaires(?array $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }
}
