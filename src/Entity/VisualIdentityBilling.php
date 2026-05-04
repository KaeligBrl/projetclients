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
}
