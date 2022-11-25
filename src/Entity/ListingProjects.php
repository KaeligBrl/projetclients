<?php

namespace App\Entity;

use App\Repository\ListingProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255)
     */
    private $websitetype;

    /**
     * @ORM\ManyToMany(targetEntity=Filters::class, inversedBy="listingProjects")
     */
    private $name;

    public function __construct()
    {
        $this->name = new ArrayCollection();
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

    public function getWebsitetype(): ?string
    {
        return $this->websitetype;
    }

    public function setWebsitetype(string $websitetype): self
    {
        $this->websitetype = $websitetype;

        return $this;
    }

    /**
     * @return Collection<int, Filters>
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(Filters $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
        }

        return $this;
    }

    public function removeName(Filters $name): self
    {
        $this->name->removeElement($name);

        return $this;
    }

}
