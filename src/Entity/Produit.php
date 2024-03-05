<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_produit;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Get creative and think of a title!")
     */
    private $nom_produit;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Get creative and think of a title!")
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Get creative and think of a title!")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;
    private $file;

    public function getId(): ?int
    {
        return $this->id_produit;
    }
    public function getFile(): ?string
    {
        return $this->id;
    }
    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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
}
