<?php

namespace App\Entity;

use App\Repository\FiltersEnterprisesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=FiltersEnterprisesRepository::class)
 * @UniqueEntity(
 * fields= {"name"},
 * message= "Ce filtre a déjà été créé !"
 * )
 */
class FiltersEnterprises
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=ListingProjects::class, mappedBy="nameEnterprises")
     */
    private $listingProjects;

    public function __construct()
    {
        $this->listingProjects = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ListingProjects>
     */
    public function getListingProjects(): Collection
    {
        return $this->listingProjects;
    }

    public function addListingProject(ListingProjects $listingProject): self
    {
        if (!$this->listingProjects->contains($listingProject)) {
            $this->listingProjects[] = $listingProject;
            $listingProject->addEnterprises($this);
        }

        return $this;
    }

    public function removeListingProject(ListingProjects $listingProject): self
    {
        if ($this->listingProjects->removeElement($listingProject)) {
            $listingProject->removeEntreprises($this);
        }

        return $this;
    }
}