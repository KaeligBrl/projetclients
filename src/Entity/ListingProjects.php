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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=FiltersWebsites::class, inversedBy="listingProjects")
     */
    private $nameWebsites;

    public function __construct()
    {
        $this->name = new ArrayCollection();
        $this->nameWebsites = new ArrayCollection();
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
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(FiltersActivities $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
        }

        return $this;
    }

    public function removeName(FiltersWebsites $names): self
    {
        $this->names->removeElement($names);

        return $this;
    }

}
