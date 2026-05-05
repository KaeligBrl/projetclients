<?php

namespace App\Controller\Back\Billing;

use App\Entity\VisualIdentityBilling;
use App\Repository\EmailSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class AdminViBillingToggleController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MailerInterface $mailer,
        private EmailSettingRepository $settingRepository,
    ) {}

    private function sendEmail(VisualIdentityBilling $billing, string $checkboxKey): void
    {
        $setting = $this->settingRepository->findOneBy(['section' => 'visual_identity', 'checkboxKey' => $checkboxKey]);
        if (!$setting || !$setting->getRecipientEmail()) {
            return;
        }
        $clientName = $billing->getVisualIdentityProject()->getCustomer()?->getEntreprise() ?? 'Client';
        $body = str_replace(
            ['{client}', '{section}'],
            [$clientName, 'Identité visuelle'],
            $setting->getMessageBody() ?? ''
        );
        $email = (new Email())
            ->from('noreply@projetsclients.local')
            ->to($setting->getRecipientEmail())
            ->subject(str_replace(['{client}', '{section}'], [$clientName, 'Identité visuelle'], $setting->getSubject() ?? '(sans sujet)'))
            ->text($body);
        $this->mailer->send($email);
    }

    #[Route('/admin/facturation-identite-visuelle/acompte-facture/{id}', name: 'admin_vi_billing_deposit_invoiced')]
    public function toggleDepositInvoiced(VisualIdentityBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getDepositInvoiced();
        $billing->setDepositInvoiced($new);
        if (!$new) { $billing->setDepositPaid(false); }
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'deposit_invoiced'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-identite-visuelle/acompte-paye/{id}', name: 'admin_vi_billing_deposit_paid')]
    public function toggleDepositPaid(VisualIdentityBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getDepositPaid();
        $billing->setDepositPaid($new);
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'deposit_paid'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-identite-visuelle/admin-facture/{id}', name: 'admin_vi_billing_status_invoiced')]
    public function toggleStatusInvoiced(VisualIdentityBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getStatusInvoiced();
        $billing->setStatusInvoiced($new);
        if (!$new) { $billing->setStatusPaid(false); }
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'status_invoiced'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-identite-visuelle/admin-paye/{id}', name: 'admin_vi_billing_status_paid')]
    public function toggleStatusPaid(VisualIdentityBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getStatusPaid();
        $billing->setStatusPaid($new);
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'status_paid'); }
        return new Response('true');
    }
}
