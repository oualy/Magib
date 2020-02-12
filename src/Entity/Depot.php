<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource( normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}})
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 */
class Depot
{
    /**
     * @Groups({"read","write"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private $montantdepot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $depot;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="depots")
     */
    private $trans;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantdepot(): ?int
    {
        return $this->montantdepot;
    }

    public function setMontantdepot(int $montantdepot): self
    {
        $this->montantdepot = $montantdepot;

        return $this;
    }

    public function getDepot(): ?Utilisateur
    {
        return $this->depot;
    }

    public function setDepot(?Utilisateur $depot): self
    {
        $this->depot = $depot;

        return $this;
    }

    public function getTrans(): ?Compte
    {
        return $this->trans;
    }

    public function setTrans(?Compte $trans): self
    {
        $this->trans = $trans;

        return $this;
    }

    
}
