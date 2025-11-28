<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 * @UniqueEntity(
 * fields= {"customer"},
 * message= "Ce client a déjà été ajouté"
 * )
 */
class Projects
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable="true")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="customer")
     */
    private $customer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $customerbrief;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $comingsoon;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $customercontentreception;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $webdesignprogress;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $webdesignsend;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $webdesignvalidated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $domainname;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $webintegration;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $webtraining;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $online;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $finished;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $wordpressInstallation;

    // Constructeur supprimé (aucune collection à initialiser)

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomerbrief(): ?bool
    {
        return $this->customerbrief;
    }

    public function setCustomerbrief(?bool $customerbrief): self
    {
        $this->customerbrief = $customerbrief;

        return $this;
    }

    public function getComingsoon(): ?bool
    {
        return $this->comingsoon;
    }

    public function setComingsoon(?bool $comingsoon): self
    {
        $this->comingsoon = $comingsoon;

        return $this;
    }

    public function getCustomercontentreception(): ?bool
    {
        return $this->customercontentreception;
    }

    public function setCustomercontentreception(?bool $customercontentreception): self
    {
        $this->customercontentreception = $customercontentreception;

        return $this;
    }

    public function getWebdesignprogress(): ?bool
    {
        return $this->webdesignprogress;
    }

    public function setWebdesignprogress(?bool $webdesignprogress): self
    {
        $this->webdesignprogress = $webdesignprogress;

        return $this;
    }

    public function getWebdesignsend(): ?bool
    {
        return $this->webdesignsend;
    }

    public function setWebdesignsend(?bool $webdesignsend): self
    {
        $this->webdesignsend = $webdesignsend;

        return $this;
    }

    public function getWebdesignvalidated(): ?bool
    {
        return $this->webdesignvalidated;
    }

    public function setWebdesignvalidated(?bool $webdesignvalidated): self
    {
        $this->webdesignvalidated = $webdesignvalidated;

        return $this;
    }

    public function getDomainname(): ?bool
    {
        return $this->domainname;
    }

    public function setDomainname(bool $domainname): self
    {
        $this->domainname = $domainname;

        return $this;
    }

    public function getWebintegration(): ?bool
    {
        return $this->webintegration;
    }

    public function setWebintegration(?bool $webintegration): self
    {
        $this->webintegration = $webintegration;

        return $this;
    }

    public function getWebtraining(): ?bool
    {
        return $this->webtraining;
    }

    public function setWebtraining(?bool $webtraining): self
    {
        $this->webtraining = $webtraining;

        return $this;
    }

    public function getOnline(): ?\DateTimeInterface
    {
        return $this->online;
    }

    public function setOnline(?\DateTimeInterface $online): self
    {
        $this->online = $online;

        return $this;
    }

    public function getFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(?bool $finished): self
    {
        $this->finished = $finished;

        return $this;
    }

    public function getWordpressInstallation(): ?\DateTimeInterface
    {
        return $this->wordpressInstallation;
    }

    public function setWordpressInstallation(?\DateTimeInterface $wordpressInstallation): self
    {
        $this->wordpressInstallation = $wordpressInstallation;

        return $this;
    }

}
