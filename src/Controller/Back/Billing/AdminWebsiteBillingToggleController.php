<?php

namespace App\Controller\Back\Billing;

use App\Entity\WebsiteBilling;
use App\Repository\EmailSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class AdminWebsiteBillingToggleController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MailerInterface $mailer,
        private EmailSettingRepository $settingRepository,
    ) {}

    private function sendEmail(WebsiteBilling $billing, string $checkboxKey): void
    {
        $setting = $this->settingRepository->findOneBy(['section' => 'website', 'checkboxKey' => $checkboxKey]);
        if (!$setting || !$setting->getRecipientEmail()) {
            return;
        }
        $clientName = $billing->getWebsiteProject()->getCustomer()?->getEntreprise() ?? 'Client';
        $body = str_replace(
            ['{client}', '{section}'],
            [$clientName, 'Sites web'],
            $setting->getMessageBody() ?? ''
        );
        $email = (new Email())
            ->from('noreply@projetsclients.local')
            ->to($setting->getRecipientEmail())
            ->subject(str_replace(['{client}', '{section}'], [$clientName, 'Sites web'], $setting->getSubject() ?? '(sans sujet)'))
            ->text($body);
        $this->mailer->send($email);
    }

    #[Route('/admin/facturation-sites-web/acompte-facture/{id}', name: 'admin_website_billing_deposit_invoiced')]
    public function toggleDepositInvoiced(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getDepositInvoiced();
        $billing->setDepositInvoiced($new);
        if (!$new) { $billing->setDepositPaid(false); }
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'deposit_invoiced'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-sites-web/acompte-paye/{id}', name: 'admin_website_billing_deposit_paid')]
    public function toggleDepositPaid(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getDepositPaid();
        $billing->setDepositPaid($new);
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'deposit_paid'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-sites-web/maquette-facturee/{id}', name: 'admin_website_billing_mockup_invoiced')]
    public function toggleMockupInvoiced(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getMockupSentInvoiced();
        $billing->setMockupSentInvoiced($new);
        if (!$new) { $billing->setMockupSentPaid(false); }
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'mockup_sent_invoiced'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-sites-web/maquette-payee/{id}', name: 'admin_website_billing_mockup_paid')]
    public function toggleMockupPaid(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getMockupSentPaid();
        $billing->setMockupSentPaid($new);
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'mockup_sent_paid'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-sites-web/formation-facturee/{id}', name: 'admin_website_billing_training_invoiced')]
    public function toggleTrainingInvoiced(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getOnboardingTrainingInvoiced();
        $billing->setOnboardingTrainingInvoiced($new);
        if (!$new) { $billing->setOnboardingTrainingPaid(false); }
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'onboarding_training_invoiced'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-sites-web/formation-payee/{id}', name: 'admin_website_billing_training_paid')]
    public function toggleTrainingPaid(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getOnboardingTrainingPaid();
        $billing->setOnboardingTrainingPaid($new);
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'onboarding_training_paid'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-sites-web/admin-facture/{id}', name: 'admin_website_billing_status_invoiced')]
    public function toggleStatusInvoiced(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getStatusInvoiced();
        $billing->setStatusInvoiced($new);
        if (!$new) { $billing->setStatusPaid(false); }
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'status_invoiced'); }
        return new Response('true');
    }

    #[Route('/admin/facturation-sites-web/admin-paye/{id}', name: 'admin_website_billing_status_paid')]
    public function toggleStatusPaid(WebsiteBilling $billing): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $new = !$billing->getStatusPaid();
        $billing->setStatusPaid($new);
        $this->entityManager->flush();
        if ($new) { $this->sendEmail($billing, 'status_paid'); }
        return new Response('true');
    }
}
