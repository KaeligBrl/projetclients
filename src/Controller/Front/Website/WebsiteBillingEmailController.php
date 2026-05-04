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

class WebsiteBillingEmailController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MailerInterface $mailer,
    ) {}

    #[Route('/facturation-sites-web/envoyer-email/{id}', name: 'website_billing_send_email')]
    public function send(WebsiteBilling $billing, EmailSettingRepository $settingRepository): Response
    {
        $clientName = $billing->getWebsiteProject()->getCustomer()?->getName() ?? 'Client';

        $checksMap = [
            'deposit'             => $billing->getDeposit(),
            'mockup_sent'         => $billing->getMockupSent(),
            'onboarding_training' => $billing->getOnboardingTraining(),
            'status'              => $billing->getStatus(),
        ];

        $sent = 0;
        foreach ($checksMap as $key => $checked) {
            if (!$checked) {
                continue;
            }
            $setting = $settingRepository->findOneBy(['section' => 'website', 'checkboxKey' => $key]);
            if (!$setting || !$setting->getRecipientEmail()) {
                continue;
            }

            $body = str_replace(
                ['{client}', '{section}'],
                [$clientName, 'Sites web'],
                $setting->getMessageBody() ?? ''
            );

            $email = (new Email())
                ->from('noreply@projetsclients.local')
                ->to($setting->getRecipientEmail())
                ->subject(str_replace('{client}', $clientName, $setting->getSubject() ?? '(sans sujet)'))
                ->text($body);

            $this->mailer->send($email);
            $sent++;
        }

        $this->addFlash('success', $sent > 0 ? "$sent email(s) envoyé(s) pour $clientName." : "Aucun email configuré pour les cases cochées.");

        return $this->redirectToRoute('website_billing');
    }
}
