<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use app\Controller\CompteController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource( 
 *  normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * 
 *collectionOperations={
*   "post"={
* "controller"=CompteController::class
*},
*  "get"
*},
 * itemOperations={
 *         "get"={"security"="is_granted(['ROLE_SUPER_ADMIN','ROLE_ADMIN'])"}
 * }
 *       )
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $numbecompte;

    /**
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private $solde;

    /**
     * @Groups({"read","write"})
     * @ORM\Column(type="date")
     */
    private $datedecreate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="compte")
     */
    private $usercreateur;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="comptes" ,cascade={"persist"})
     */
    private $partenaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="compte")
     */
    private $compte;

    /**
     *  @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="trans" ,cascade={"persist"})
     */
    private $depots;

    public function __construct()
    {
        $this->compte = new ArrayCollection();
        $this->depots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumbecompte(): ?string
    {
        return $this->numbecompte;
    }

    public function setNumbecompte(string $numbecompte): self
    {
        $this->numbecompte = $numbecompte;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDatedecreate(): ?\DateTimeInterface
    {
        return $this->datedecreate;
    }

    public function setDatedecreate(\DateTimeInterface $datedecreate): self
    {
        $this->datedecreate = $datedecreate;

        return $this;
    }

    public function getUsercreateur(): ?Utilisateur
    {
        return $this->usercreateur;
    }

    public function setUsercreateur(?Utilisateur $usercreateur): self
    {
        $this->usercreateur = $usercreateur;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getCompte(): Collection
    {
        return $this->compte;
    }

    public function addCompte(Depot $compte): self
    {
        if (!$this->compte->contains($compte)) {
            $this->compte[] = $compte;
            $compte->setCompte($this);
        }

        return $this;
    }

    public function removeCompte(Depot $compte): self
    {
        if ($this->compte->contains($compte)) {
            $this->compte->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getCompte() === $this) {
                $compte->setCompte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setTrans($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getTrans() === $this) {
                $depot->setTrans(null);
            }
        }

        return $this;
    }
}
