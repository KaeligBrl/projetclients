<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @UniqueEntity(
 * fields= {"name"},
 * message= "Le client existe déjà !"
 * )
 * 
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="customer")
     */
    private $customer;

    public function __construct()
    {
        $this->customer = new ArrayCollection();
        $this->websites = new ArrayCollection();
    }

    // /**
    //  * @ORM\Column(type="boolean", nullable=true)
    //  */
    // private $archived;

    public function getId(): ?int
    {
        return $this->id;
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

    public function __toString()
    {
    return $this->name;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getCustomer(): Collection
    {
        return $this->customer;
    }

    public function addCustomer(Projects $customer): self
    {
        if (!$this->customer->contains($customer)) {
            $this->customer[] = $customer;
            $customer->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomer(Projects $customer): self
    {
        if ($this->customer->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getCustomer() === $this) {
                $customer->setCustomer(null);
            }
        }

        return $this;
    }
}
