<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteBilling;
use App\Repository\EmailSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class WebsiteBillingCheckboxController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MailerInterface $mailer,
        private EmailSettingRepository $settingRepository,
    ) {}

    private function sendEmailIfConfigured(WebsiteBilling $billing, string $checkboxKey, bool $newValue): void
    {
        if (!$newValue) {
            return;
        }
        $setting = $this->settingRepository->findOneBy(['section' => 'website', 'checkboxKey' => $checkboxKey]);
        if (!$setting || !$setting->getRecipientEmail()) {
            return;
        }
        $customer = $billing->getWebsiteProject()->getCustomer();
        $clientName = $customer?->getEntreprise() ?? 'Client';

        $search = ['{client}', '{section}'];
        $replace = [$clientName, 'Sites web'];

        if ($checkboxKey === 'deposit') {
            $search  = array_merge($search,  ['{firstname}', '{lastname}', '{address}', '{tva}']);
            $replace = array_merge($replace, [
                $customer?->getFirstname() ?? '',
                $customer?->getLastname() ?? '',
                $customer?->getAddress()   ?? '',
                $customer?->getTva()       ?? '',
            ]);
        }

        $body = str_replace($search, $replace, $setting->getMessageBody() ?? '');
        $email = (new Email())
            ->from('noreply@projetsclients.local')
            ->to($setting->getRecipientEmail())
            ->subject(str_replace('{client}', $clientName, $setting->getSubject() ?? '(sans sujet)'))
            ->text($body);
        $this->mailer->send($email);
    }

    #[Route('/facturation-sites-web/acompte/{id}', name: 'website_billing_deposit_checkbox')]
    public function toggleDeposit(WebsiteBilling $billing): Response
    {
        $newValue = !$billing->getDeposit();
        $billing->setDeposit($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'deposit', $newValue);

        return new Response('true');
    }

    #[Route('/facturation-sites-web/maquette-envoyee/{id}', name: 'website_billing_mockup_sent_checkbox')]
    public function toggleMockupSent(WebsiteBilling $billing): Response
    {
        $newValue = !$billing->getMockupSent();
        $billing->setMockupSent($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'mockup_sent', $newValue);

        return new Response('true');
    }

    #[Route('/facturation-sites-web/formation/{id}', name: 'website_billing_onboarding_training_checkbox')]
    public function toggleOnboardingTraining(WebsiteBilling $billing): Response
    {
        $newValue = !$billing->getOnboardingTraining();
        $billing->setOnboardingTraining($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'onboarding_training', $newValue);

        return new Response('true');
    }

    #[Route('/facturation-sites-web/envoi-administratif/{id}', name: 'website_billing_status_checkbox')]
    public function toggleStatus(WebsiteBilling $billing): Response
    {
        $newValue = !$billing->getStatus();
        $billing->setStatus($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'status', $newValue);

        return new Response('true');
    }

    #[Route('/facturation-sites-web/facture/{id}', name: 'website_billing_invoiced_checkbox')]
    public function toggleInvoiced(WebsiteBilling $billing): Response
    {
        $newValue = !$billing->getInvoiced();
        $billing->setInvoiced($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'invoiced', $newValue);

        return new Response('true');
    }

    #[Route('/facturation-sites-web/paye/{id}', name: 'website_billing_paid_checkbox')]
    public function togglePaid(WebsiteBilling $billing): Response
    {
        $newValue = !$billing->getPaid();
        $billing->setPaid($newValue);
        $this->entityManager->flush();
        $this->sendEmailIfConfigured($billing, 'paid', $newValue);

        return new Response('true');
    }
}
