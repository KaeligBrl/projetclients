<?php

namespace App\Entity;

use App\Repository\FiltersWebsitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=FiltersWebsitesRepository::class)
 * @UniqueEntity(
 * fields= {"nameWebsites"},
 * message= "Ce filtre a déjà été créé !"
 * )
 */
class FiltersWebsites
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
    private $nameWebsites;

    /**
     * @ORM\ManyToMany(targetEntity=ListingProjects::class, mappedBy="nameWebsites")
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

    public function getNameWebsites(): ?string
    {
        return $this->nameWebsites;
    }

    public function setNameWebsites(string $nameWebsites): self
    {
        $this->nameWebsites = $nameWebsites;

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
            $listingProject->addNameWebsites($this);
        }

        return $this;
    }

    public function removeListingProject(ListingProjects $listingProject): self
    {
        if ($this->listingProjects->removeElement($listingProject)) {
            $listingProject->removeNameWebsites($this);
        }

        return $this;
    }
}