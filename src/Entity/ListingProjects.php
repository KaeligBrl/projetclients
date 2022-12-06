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
    private $domainname;

    /**
     * @ORM\ManyToMany(targetEntity=FiltersActivities::class, inversedBy="listingProjects")
     */
    private $nameActivities;

    /**
     * @ORM\ManyToMany(targetEntity=FiltersWebsites::class, inversedBy="listingProjects")
     */
    private $nameWebsites;

    /**
     * @ORM\ManyToMany(targetEntity=FiltersEnterprises::class, inversedBy="listingProjects")
     */
    private $nameEnterprises;

    public function __construct()
    {
        $this->nameActivities = new ArrayCollection();
        $this->nameWebsites = new ArrayCollection();
        $this->nameEnterprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomainname(): ?string
    {
        return $this->domainname;
    }

    public function setDomainname(string $domainname): self
    {
        $this->domainname = $domainname;

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
        $this->namesActivities->removeElement($namesActivities);

        return $this;
    }


    /**
     * @return Collection<int, FiltersEnterprises>
     */
    public function getNameEnterprise(): Collection
    {
        return $this->nameEnterprises;
    }

    public function addNameEnterprise(FiltersEnterprises $nameEnterprises): self
    {
        if (!$this->nameEnterprises->contains($nameEnterprises)) {
            $this->nameEnterprises[] = $nameEnterprises;
        }

        return $this;
    }

    public function removeNameEnterprise(FiltersEnterprises $nameEnterprises): self
    {
        $this->nameEnterprises->removeElement($nameEnterprises);

        return $this;
    }

}
