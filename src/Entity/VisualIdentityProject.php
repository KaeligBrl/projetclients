<?php

namespace App\Entity;

use App\Repository\VisualIdentityProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: VisualIdentityProjectRepository::class)]
#[ORM\Table(name: 'visual_identity_project')]
#[UniqueEntity(fields: ['customer'], message: 'Ce client a déjà un projet d\'identité visuelle')]
class VisualIdentityProject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $customerBrief = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $appointmentScheduled = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $presentationDone = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $reworkDone = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $validated = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $declinationsDone = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $filesDelivered = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $finished = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomerBrief(): ?bool
    {
        return $this->customerBrief;
    }

    public function setCustomerBrief(?bool $customerBrief): static
    {
        $this->customerBrief = $customerBrief;
        return $this;
    }

    public function getAppointmentScheduled(): ?bool
    {
        return $this->appointmentScheduled;
    }

    public function setAppointmentScheduled(?bool $appointmentScheduled): static
    {
        $this->appointmentScheduled = $appointmentScheduled;
        return $this;
    }

    public function getPresentationDone(): ?bool
    {
        return $this->presentationDone;
    }

    public function setPresentationDone(?bool $presentationDone): static
    {
        $this->presentationDone = $presentationDone;
        return $this;
    }

    public function getReworkDone(): ?bool
    {
        return $this->reworkDone;
    }

    public function setReworkDone(?bool $reworkDone): static
    {
        $this->reworkDone = $reworkDone;
        return $this;
    }

    public function getValidated(): ?bool
    {
        return $this->validated;
    }

    public function setValidated(?bool $validated): static
    {
        $this->validated = $validated;
        return $this;
    }

    public function getDeclinationsDone(): ?bool
    {
        return $this->declinationsDone;
    }

    public function setDeclinationsDone(?bool $declinationsDone): static
    {
        $this->declinationsDone = $declinationsDone;
        return $this;
    }

    public function getFilesDelivered(): ?bool
    {
        return $this->filesDelivered;
    }

    public function setFilesDelivered(?bool $filesDelivered): static
    {
        $this->filesDelivered = $filesDelivered;
        return $this;
    }

    public function getFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(?bool $finished): static
    {
        $this->finished = $finished;
        return $this;
    }
}
