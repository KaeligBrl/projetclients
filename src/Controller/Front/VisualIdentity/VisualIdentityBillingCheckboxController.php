<?php

namespace App\Controller\Front\VisualIdentity;

use App\Entity\VisualIdentityBilling;
use App\Repository\EmailSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityBillingCheckboxController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MailerInterface $mailer,
        private EmailSettingRepository $settingRepository,
    ) {}

    private function sendEmailIfConfigured(VisualIdentityBilling $billing, string $checkboxKey, bool $newValue): void
    {
        if (!$newValue) {
            return;
        }
        $setting = $this->settingRepository->findOneBy(['section' => 'visual_identity', 'checkboxKey' => $checkboxKey]);
        if (!$setting || !$setting->getRecipientEmail()) {
            return;
        }
        $clientName = $billing->getVisualIdentityProject()->getCustomer()?->getName() ?? 'Client';
        $body = str_replace(
            ['{client}', '{section}'],
            [$clientName, 'Identité visuelle'],
            $setting->getMessageBody() ?? ''
        );
        $email = (new Email())
            ->from('noreply@projetsclients.local')
            ->to($setting->getRecipientEmail())
            ->subject(str_replace('{client}', $clientName, $setting->getSubject() ?? '(sans sujet)'))
            ->text($body);
        $this->mailer->send($email);
    }

    #[Route('/facturation-identite-visuelle/acompte/{id}', name: 'vi_billing_deposit_checkbox')]
    public function toggleDeposit(VisualIdentityBilling $billing): Response
    {
        $newValue = !$billing->getDeposit();
        $billing->setDeposit($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'deposit', $newValue);

        return new Response('true');
    }

    #[Route('/facturation-identite-visuelle/envoi-administratif/{id}', name: 'vi_billing_status_checkbox')]
    public function toggleStatus(VisualIdentityBilling $billing): Response
    {
        $newValue = !$billing->getStatus();
        $billing->setStatus($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'status', $newValue);

        return new Response('true');
    }
}
