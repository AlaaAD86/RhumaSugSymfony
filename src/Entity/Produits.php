<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsRepository")
 */
class Produits
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Panier", mappedBy="produit")
     */
    private $paniers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommProd", mappedBy="prod")
     */
    private $commProds;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->paniers = new ArrayCollection();
        $this->commProds = new ArrayCollection();
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
     * @return Collection|Panier[]
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers[] = $panier;
            $panier->setProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->contains($panier)) {
            $this->paniers->removeElement($panier);
            // set the owning side to null (unless already changed)
            if ($panier->getProduit() === $this) {
                $panier->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommProd[]
     */
    public function getCommProds(): Collection
    {
        return $this->commProds;
    }

    public function addCommProd(CommProd $commProd): self
    {
        if (!$this->commProds->contains($commProd)) {
            $this->commProds[] = $commProd;
            $commProd->setProd($this);
        }

        return $this;
    }

    public function removeCommProd(CommProd $commProd): self
    {
        if ($this->commProds->contains($commProd)) {
            $this->commProds->removeElement($commProd);
            // set the owning side to null (unless already changed)
            if ($commProd->getProd() === $this) {
                $commProd->setProd(null);
            }
        }

        return $this;
    }


}
