<?php

namespace App\Entity;

use App\Entity\FiltersActivities;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\ListingProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ListingProjectsRepository::class)
 */
class ListingProjects
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
    private $enterprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domainName;

    /**
     * @ORM\ManyToMany(targetEntity=FiltersActivities::class, inversedBy="listingProjects")
     */
    private $nameActivities;

    /**
     * @ORM\ManyToMany(targetEntity=FiltersWebsites::class, inversedBy="listingProjects")
     */
    private $nameWebsites;

    /**
     * @ORM\ManyToMany(targetEntity=FilterEnterpriseType::class, inversedBy="listingProjects")
     */
    private $nameEnterpriseType;

    public function __construct()
    {
        $this->nameActivities = new ArrayCollection();
        $this->nameWebsites = new ArrayCollection();
        $this->nameEnterpriseType = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnterprise(): ?string
    {
        return $this->enterprise;
    }

    public function setEnterprise(string $entreprise): self
    {
        $this->enterprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection<int, FiltersWebsites>
     */
    public function getNameWebsites(): Collection
    {
        return $this->nameWebsites;
    }

    public function addNameWebsite(FiltersWebsites $nameWebsite): self
    {
        if (!$this->nameWebsites->contains($nameWebsite)) {
            $this->nameWebsites[] = $nameWebsite;
        }

        return $this;
    }

    public function removeNameWebsite(FiltersWebsites $nameWebsites): self
    {
        $this->nameWebsites->removeElement($nameWebsites);

        return $this;
    }

    /**
     * @return Collection<int, FiltersActivities>
     */
    public function getNameActivities(): Collection
    {
        return $this->nameActivities;
    }

    public function addNameActivities(FiltersActivities $nameActivities): self
    {
        if (!$this->nameActivities->contains($nameActivities)) {
            $this->nameActivities[] = $nameActivities;
        }

        return $this;
    }

    public function removeNameActivities(FiltersWebsites $namesActivities): self
    {
        $this->nameActivities->removeElement($namesActivities);

        return $this;
    }

    /**
     * @return Collection<int, FilterEnterprise>
     */
    public function getNameEnterpriseType(): Collection
    {
        return $this->nameEnterpriseType;
    }

    public function addNameEnterpriseType(FilterEnterprise $nameEnterpriseType): self
    {
        if (!$this->nameEnterpriseType->contains($nameEnterpriseType)) {
            $this->nameEnterpriseType[] = $nameEnterpriseType;
        }

        return $this;
    }

    public function removeNameEnterpriseType(FilterEnterprise $nameEnterprisesType): self
    {
        $this->nameEnterpriseType->removeElement($nameEnterprisesType);

        return $this;
    }

 
    public function getDomainName()
    {
        return $this->domainName;
    }

    public function setDomainName($domainName)
    {
        $this->domainName = $domainName;

        return $this;
    }
}
