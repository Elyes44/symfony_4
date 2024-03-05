<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_total;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     * @ORM\JoinTable(name="prod_commande",
     *      joinColumns={@ORM\JoinColumn(name="commande_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="prod_id", referencedColumnName="id_produit")}
     * )
     */
    private $listprod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    public function __construct()
    {
        $this->listprod = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prix_total;
    }

    public function setPrixTotal(float $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getListprod(): Collection
    {
        return $this->listprod;
    }

    public function addListprod(Produit $listprod): self
    {
        if (!$this->listprod->contains($listprod)) {
            $this->listprod[] = $listprod;
        }

        return $this;
    }

    public function removeListprod(Produit $listprod): self
    {
        $this->listprod->removeElement($listprod);

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
