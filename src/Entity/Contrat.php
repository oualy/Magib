<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contrat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datecreatecontrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatecreatecontrat(): ?\DateTimeInterface
    {
        return $this->datecreatecontrat;
    }

    public function setDatecreatecontrat(\DateTimeInterface $datecreatecontrat): self
    {
        $this->datecreatecontrat = $datecreatecontrat;

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;

        return $this;
    }
}
