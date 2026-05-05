<?php

namespace App\Entity;

use App\Repository\WebsiteBillingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebsiteBillingRepository::class)]
#[ORM\Table(name: 'website_billing')]
class WebsiteBilling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: WebsiteProject::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?WebsiteProject $websiteProject = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $status = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $deposit = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $mockupSent = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $onboardingTraining = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $invoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $depositInvoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $mockupSentInvoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $onboardingTrainingInvoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $statusInvoiced = false;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebsiteProject(): ?WebsiteProject
    {
        return $this->websiteProject;
    }

    public function setWebsiteProject(?WebsiteProject $websiteProject): static
    {
        $this->websiteProject = $websiteProject;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDeposit(): ?bool
    {
        return $this->deposit;
    }

    public function setDeposit(bool $deposit): static
    {
        $this->deposit = $deposit;

        return $this;
    }

    public function getMockupSent(): ?bool
    {
        return $this->mockupSent;
    }

    public function setMockupSent(bool $mockupSent): static
    {
        $this->mockupSent = $mockupSent;

        return $this;
    }

    public function getOnboardingTraining(): ?bool
    {
        return $this->onboardingTraining;
    }

    public function setOnboardingTraining(bool $onboardingTraining): static
    {
        $this->onboardingTraining = $onboardingTraining;

        return $this;
    }

    public function getInvoiced(): ?bool { return $this->invoiced; }
    public function setInvoiced(bool $invoiced): static { $this->invoiced = $invoiced; return $this; }

    public function getDepositInvoiced(): ?bool { return $this->depositInvoiced; }
    public function setDepositInvoiced(bool $v): static { $this->depositInvoiced = $v; return $this; }

    public function getMockupSentInvoiced(): ?bool { return $this->mockupSentInvoiced; }
    public function setMockupSentInvoiced(bool $v): static { $this->mockupSentInvoiced = $v; return $this; }

    public function getOnboardingTrainingInvoiced(): ?bool { return $this->onboardingTrainingInvoiced; }
    public function setOnboardingTrainingInvoiced(bool $v): static { $this->onboardingTrainingInvoiced = $v; return $this; }

    public function getStatusInvoiced(): ?bool { return $this->statusInvoiced; }
    public function setStatusInvoiced(bool $v): static { $this->statusInvoiced = $v; return $this; }
}