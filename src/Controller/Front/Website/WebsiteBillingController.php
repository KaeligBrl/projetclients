<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteBilling;
use App\Repository\EmailSettingRepository;
use App\Repository\WebsiteBillingRepository;
use App\Repository\WebsiteProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WebsiteBillingController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/facturation-sites-web', name: 'website_billing')]
    public function index(
        WebsiteProjectRepository $projectRepository,
        WebsiteBillingRepository $billingRepository,
        EmailSettingRepository $emailSettingRepository,
    ): Response {
        $projects = $projectRepository->findBy([], ['id' => 'ASC']);

        foreach ($projects as $project) {
            $billing = $billingRepository->findOneBy(['websiteProject' => $project]);
            if (!$billing) {
                $billing = new WebsiteBilling();
                $billing->setWebsiteProject($project);
                $billing->setLabel($project->getCustomer()?->getEntreprise() ?? '');
                $this->entityManager->persist($billing);
            }
        }
        $this->entityManager->flush();

        $billings = $billingRepository->findBy([], ['id' => 'ASC']);

        $mailEnabled = [
            'deposit' => false,
            'mockup_sent' => false,
            'onboarding_training' => false,
            'status' => false,
        ];

        foreach ($emailSettingRepository->findBySection('website') as $setting) {
            $key = $setting->getCheckboxKey();
            if ($key === null || !array_key_exists($key, $mailEnabled)) {
                continue;
            }
            $mailEnabled[$key] = !empty(trim((string) $setting->getRecipientEmail()));
        }

        $hasUnavailableSteps = in_array(false, $mailEnabled, true);

        return $this->render('front/website_billing/index.html.twig', [
            'billings' => $billings,
            'mailEnabled' => $mailEnabled,
            'hasUnavailableSteps' => $hasUnavailableSteps,
        ]);
    }
}
