<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteBilling;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WebsiteBillingCheckboxController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/facturation-sites-web/acompte/{id}', name: 'website_billing_deposit_checkbox')]
    public function toggleDeposit(WebsiteBilling $billing): Response
    {
        $billing->setDeposit(!$billing->getDeposit());
        $this->entityManager->flush();

        return new Response('true');
    }

    #[Route('/facturation-sites-web/maquette-envoyee/{id}', name: 'website_billing_mockup_sent_checkbox')]
    public function toggleMockupSent(WebsiteBilling $billing): Response
    {
        $billing->setMockupSent(!$billing->getMockupSent());
        $this->entityManager->flush();

        return new Response('true');
    }

    #[Route('/facturation-sites-web/formation/{id}', name: 'website_billing_onboarding_training_checkbox')]
    public function toggleOnboardingTraining(WebsiteBilling $billing): Response
    {
        $billing->setOnboardingTraining(!$billing->getOnboardingTraining());
        $this->entityManager->flush();

        return new Response('true');
    }

    #[Route('/facturation-sites-web/envoi-administratif/{id}', name: 'website_billing_status_checkbox')]
    public function toggleStatus(WebsiteBilling $billing): Response
    {
        $billing->setStatus(!$billing->getStatus());
        $this->entityManager->flush();

        return new Response('true');
    }
}
