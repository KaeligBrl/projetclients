<?php

namespace App\Entity;

use App\Repository\EmailSettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmailSettingRepository::class)]
#[ORM\Table(name: 'email_setting')]
#[ORM\UniqueConstraint(name: 'uniq_section_key', columns: ['section', 'checkbox_key'])]
class EmailSetting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * 'website' ou 'visual_identity'
     */
    #[ORM\Column(type: 'string', length: 50)]
    private ?string $section = null;

    /**
     * ex: 'deposit', 'mockup_sent', 'onboarding_training', 'status'
     */
    #[ORM\Column(type: 'string', length: 50, name: 'checkbox_key')]
    private ?string $checkboxKey = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $recipientEmail = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $subject = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $messageBody = null;

    public function getId(): ?int { return $this->id; }

    public function getSection(): ?string { return $this->section; }
    public function setSection(string $section): static { $this->section = $section; return $this; }

    public function getCheckboxKey(): ?string { return $this->checkboxKey; }
    public function setCheckboxKey(string $checkboxKey): static { $this->checkboxKey = $checkboxKey; return $this; }

    public function getRecipientEmail(): ?string { return $this->recipientEmail; }
    public function setRecipientEmail(?string $recipientEmail): static { $this->recipientEmail = $recipientEmail; return $this; }

    public function getSubject(): ?string { return $this->subject; }
    public function setSubject(?string $subject): static { $this->subject = $subject; return $this; }

    public function getMessageBody(): ?string { return $this->messageBody; }
    public function setMessageBody(?string $messageBody): static { $this->messageBody = $messageBody; return $this; }
}
