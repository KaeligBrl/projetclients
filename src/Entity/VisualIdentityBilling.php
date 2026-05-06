<?php

namespace App\Entity;

use App\Repository\VisualIdentityBillingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisualIdentityBillingRepository::class)]
#[ORM\Table(name: 'visual_identity_billing')]
class VisualIdentityBilling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: VisualIdentityProject::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?VisualIdentityProject $visualIdentityProject = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $deposit = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $status = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $invoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $paid = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $depositInvoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $depositPaid = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $logoValidation = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $logoValidationInvoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $logoValidationPaid = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $statusInvoiced = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $statusPaid = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisualIdentityProject(): ?VisualIdentityProject
    {
        return $this->visualIdentityProject;
    }

    public function setVisualIdentityProject(?VisualIdentityProject $visualIdentityProject): static
    {
        $this->visualIdentityProject = $visualIdentityProject;

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

    public function getDeposit(): ?bool
    {
        return $this->deposit;
    }

    public function setDeposit(bool $deposit): static
    {
        $this->deposit = $deposit;

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

    public function getInvoiced(): ?bool { return $this->invoiced; }
    public function setInvoiced(bool $invoiced): static { $this->invoiced = $invoiced; return $this; }

    public function getPaid(): ?bool { return $this->paid; }
    public function setPaid(bool $paid): static { $this->paid = $paid; return $this; }

    public function getDepositInvoiced(): ?bool { return $this->depositInvoiced; }
    public function setDepositInvoiced(bool $v): static { $this->depositInvoiced = $v; return $this; }

    public function getDepositPaid(): ?bool { return $this->depositPaid; }
    public function setDepositPaid(bool $v): static { $this->depositPaid = $v; return $this; }

    public function getStatusInvoiced(): ?bool { return $this->statusInvoiced; }
    public function setStatusInvoiced(bool $v): static { $this->statusInvoiced = $v; return $this; }

    public function getStatusPaid(): ?bool { return $this->statusPaid; }
    public function setStatusPaid(bool $v): static { $this->statusPaid = $v; return $this; }

    public function getLogoValidation(): ?bool { return $this->logoValidation; }
    public function setLogoValidation(bool $v): static { $this->logoValidation = $v; return $this; }

    public function getLogoValidationInvoiced(): ?bool { return $this->logoValidationInvoiced; }
    public function setLogoValidationInvoiced(bool $v): static { $this->logoValidationInvoiced = $v; return $this; }

    public function getLogoValidationPaid(): ?bool { return $this->logoValidationPaid; }
    public function setLogoValidationPaid(bool $v): static { $this->logoValidationPaid = $v; return $this; }
}
