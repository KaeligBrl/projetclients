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
    private $picturesreception;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentcustomerbrief;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentcomingsoon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentcustomercontentreception;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentpicturesreception;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentwebdesignprogress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentwebdesignsend;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentwebdesignvalidated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentdomainname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentwebintegration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentwebtraining;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datecustomerbrief;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datedomainname;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datecomingsoon;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datecustomercontentreception;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datepicturesreception;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datewebdesignprogress;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datewebdesignsend;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datewebdesignvalidated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datewebintegration;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datewebtraining;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $finished;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $wordpressInstallation;
    
    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

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

    public function getPicturesreception(): ?bool
    {
        return $this->picturesreception;
    }

    public function setPicturesreception(?bool $picturesreception): self
    {
        $this->picturesreception = $picturesreception;

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

    public function getCommentcustomerbrief(): ?string
    {
        return $this->commentcustomerbrief;
    }

    public function setCommentcustomerbrief(?string $commentcustomerbrief): self
    {
        $this->commentcustomerbrief = $commentcustomerbrief;

        return $this;
    }

    public function getCommentcomingsoon(): ?string
    {
        return $this->commentcomingsoon;
    }

    public function setCommentcomingsoon(?string $commentcomingsoon): self
    {
        $this->commentcomingsoon = $commentcomingsoon;

        return $this;
    }

    public function getCommentcustomercontentreception(): ?string
    {
        return $this->commentcustomercontentreception;
    }

    public function setCommentcustomercontentreception(?string $commentcustomercontentreception): self
    {
        $this->commentcustomercontentreception = $commentcustomercontentreception;

        return $this;
    }

    public function getCommentpicturesreception(): ?string
    {
        return $this->commentpicturesreception;
    }

    public function setCommentpicturesreception(?string $commentpicturesreception): self
    {
        $this->commentpicturesreception = $commentpicturesreception;

        return $this;
    }

    public function getCommentwebdesignprogress(): ?string
    {
        return $this->commentwebdesignprogress;
    }

    public function setCommentwebdesignprogress(?string $commentwebdesignprogress): self
    {
        $this->commentwebdesignprogress = $commentwebdesignprogress;

        return $this;
    }

    public function getCommentwebdesignsend(): ?string
    {
        return $this->commentwebdesignsend;
    }

    public function setCommentwebdesignsend(?string $commentwebdesignsend): self
    {
        $this->commentwebdesignsend = $commentwebdesignsend;

        return $this;
    }

    public function getCommentwebdesignvalidated(): ?string
    {
        return $this->commentwebdesignvalidated;
    }

    public function setCommentwebdesignvalidated(?string $commentwebdesignvalidated): self
    {
        $this->commentwebdesignvalidated = $commentwebdesignvalidated;

        return $this;
    }

    public function getCommentdomainname(): ?string
    {
        return $this->commentdomainname;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function setCommentdomainname(?string $commentdomainname): self
    {
        $this->commentdomainname = $commentdomainname;

        return $this;
    }

    public function getCommentwebintegration(): ?string
    {
        return $this->commentwebintegration;
    }

    public function setCommentwebintegration(?string $commentwebintegration): self
    {
        $this->commentwebintegration = $commentwebintegration;

        return $this;
    }

    public function getCommentwebtraining(): ?string
    {
        return $this->commentwebtraining;
    }

    public function setCommentwebtraining(?string $commentwebtraining): self
    {
        $this->commentwebtraining = $commentwebtraining;

        return $this;
    }
    
    public function getDatecustomerbrief(): ?\DateTimeInterface
    {
        return $this->datecustomerbrief;
    }

    public function setDatecustomerbrief(?\DateTimeInterface $datecustomerbrief): self
    {
        $this->datecustomerbrief = $datecustomerbrief;

        return $this;
    }

    public function getDatedomainname(): ?\DateTimeInterface
    {
        return $this->datedomainname;
    }

    public function setDatedomainname(?\DateTimeInterface $datedomainname): self
    {
        $this->datedomainname = $datedomainname;

        return $this;
    }

    public function getDatecomingsoon(): ?\DateTimeInterface
    {
        return $this->datecomingsoon;
    }

    public function setDatecomingsoon(?\DateTimeInterface $datecomingsoon): self
    {
        $this->datecomingsoon = $datecomingsoon;

        return $this;
    }

    public function getDatecustomercontentreception(): ?\DateTimeInterface
    {
        return $this->datecustomercontentreception;
    }

    public function setDatecustomercontentreception(?\DateTimeInterface $datecustomercontentreception): self
    {
        $this->datecustomercontentreception = $datecustomercontentreception;

        return $this;
    }

    public function getDatepicturesreception(): ?\DateTimeInterface
    {
        return $this->datepicturesreception;
    }

    public function setDatepicturesreception(?\DateTimeInterface $datepicturesreception): self
    {
        $this->datepicturesreception = $datepicturesreception;

        return $this;
    }

    public function getDatewebdesignprogress(): ?\DateTimeInterface
    {
        return $this->datewebdesignprogress;
    }

    public function setDatewebdesignprogress(?\DateTimeInterface $datewebdesignprogress): self
    {
        $this->datewebdesignprogress = $datewebdesignprogress;

        return $this;
    }

    public function getDatewebdesignsend(): ?\DateTimeInterface
    {
        return $this->datewebdesignsend;
    }

    public function setDatewebdesignsend(?\DateTimeInterface $datewebdesignsend): self
    {
        $this->datewebdesignsend = $datewebdesignsend;

        return $this;
    }

    public function getDatewebdesignvalidated(): ?\DateTimeInterface
    {
        return $this->datewebdesignvalidated;
    }

    public function setDatewebdesignvalidated(?\DateTimeInterface $datewebdesignvalidated): self
    {
        $this->datewebdesignvalidated = $datewebdesignvalidated;

        return $this;
    }

    public function getDatewebintegration(): ?\DateTimeInterface
    {
        return $this->datewebintegration;
    }

    public function setDatewebintegration(?\DateTimeInterface $datewebintegration): self
    {
        $this->datewebintegration = $datewebintegration;

        return $this;
    }

    public function getDatewebtraining(): ?\DateTimeInterface
    {
        return $this->datewebtraining;
    }

    public function setDatewebtraining(?\DateTimeInterface $datewebtraining): self
    {
        $this->datewebtraining = $datewebtraining;

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
