<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[UniqueEntity(fields: ['entreprise'], message: 'Le client existe déjà !')]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, name: 'entreprise')]
    private $entreprise;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $tva = null;

    #[ORM\OneToMany(targetEntity: WebsiteProject::class, mappedBy: 'customer')]
    private $customer;

    public function __construct()
    {
        $this->customer = new ArrayCollection();
    }

    // /**
    //  * @ORM\Column(type="boolean", nullable=true)
    //  */
    // private $archived;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(?string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function __toString()
    {
        return $this->entreprise;
    }

    /**
     * @return Collection|WebsiteProject[]
     */
    public function getCustomer(): Collection
    {
        return $this->customer;
    }

    public function addCustomer(WebsiteProject $customer): self
    {
        if (!$this->customer->contains($customer)) {
            $this->customer[] = $customer;
            $customer->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomer(WebsiteProject $customer): self
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
