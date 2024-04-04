<?php

namespace App\Entity;

use App\Repository\FilterEnterpriseTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=FilterEnterpriseTypeRepository::class)
 */
class FilterEnterpriseType
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
    private $nameEnterpriseType;

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

    public function getNameEnterpriseType(): ?string
    {
        return $this->nameEnterpriseType;
    }

    public function setNameEnterpriseType(string $nameEnterpriseType): self
    {
        $this->nameEnterpriseType = $nameEnterpriseType;

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
            $listingProject->addNameEnterpriseType($this);
        }

        return $this;
    }

    public function removeListingProject(ListingProjects $listingProject): self
    {
        if ($this->listingProjects->removeElement($listingProject)) {
            $listingProject->removeNameEnterpriseType($this);
        }

        return $this;
    }
}