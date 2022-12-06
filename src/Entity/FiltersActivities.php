<?php

namespace App\Entity;

use App\Repository\FiltersActivitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=FiltersActivitiesRepository::class)
 * @UniqueEntity(
 * fields= {"nameActivities"},
 * message= "Ce filtre a déjà été créé !"
 * )
 */
class FiltersActivities
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
    private $nameActivities;

    /**
     * @ORM\ManyToMany(targetEntity=ListingProjects::class, mappedBy="nameActivities")
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

    public function getNameActivities(): ?string
    {
        return $this->nameActivities;
    }

    public function setNameActivities(string $nameActivities): self
    {
        $this->nameActivities = $nameActivities;

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
            $listingProject->addNameActivities($this);
        }

        return $this;
    }

    public function removeListingProject(ListingProjects $listingProject): self
    {
        if ($this->listingProjects->removeElement($listingProject)) {
            $listingProject->removeNameActivities($this);
        }

        return $this;
    }


}
