<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommProdRepository")
 */
class CommProd
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="commProds")
     */
    private $comm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produits", inversedBy="commProds")
     */
    private $prod;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComm(): ?Commande
    {
        return $this->comm;
    }

    public function setComm(?Commande $comm): self
    {
        $this->comm = $comm;

        return $this;
    }

    public function getProd(): ?Produits
    {
        return $this->prod;
    }

    public function setProd(?Produits $prod): self
    {
        $this->prod = $prod;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
