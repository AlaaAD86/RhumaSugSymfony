<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
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
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommProd", mappedBy="comm")
     */
    private $commProds;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commandes")
     */
    private $client;

    public function __construct()
    {
        $this->commProds = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $commProd->setComm($this);
        }

        return $this;
    }

    public function removeCommProd(CommProd $commProd): self
    {
        if ($this->commProds->contains($commProd)) {
            $this->commProds->removeElement($commProd);
            // set the owning side to null (unless already changed)
            if ($commProd->getComm() === $this) {
                $commProd->setComm(null);
            }
        }

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

   
}
