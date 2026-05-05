<?php

namespace App\Controller\Front\VisualIdentity;

use App\Entity\VisualIdentityBilling;
use App\Repository\EmailSettingRepository;
use App\Repository\VisualIdentityBillingRepository;
use App\Repository\VisualIdentityProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityBillingController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/facturation-identite-visuelle', name: 'visual_identity_billing')]
    public function index(
        VisualIdentityProjectRepository $projectRepository,
        VisualIdentityBillingRepository $billingRepository,
        EmailSettingRepository $emailSettingRepository,
    ): Response {
        $projects = $projectRepository->findBy([], ['id' => 'ASC']);

        foreach ($projects as $project) {
            $billing = $billingRepository->findOneBy(['visualIdentityProject' => $project]);
            if (!$billing) {
                $billing = new VisualIdentityBilling();
                $billing->setVisualIdentityProject($project);
                $billing->setLabel($project->getCustomer()?->getName() ?? '');
                $this->entityManager->persist($billing);
            }
        }
        $this->entityManager->flush();

        $billings = $billingRepository->findBy([], ['id' => 'ASC']);

        $mailEnabled = [
            'deposit' => false,
            'status' => false,
        ];

        foreach ($emailSettingRepository->findBySection('visual_identity') as $setting) {
            $key = $setting->getCheckboxKey();
            if ($key === null || !array_key_exists($key, $mailEnabled)) {
                continue;
            }
            $mailEnabled[$key] = !empty(trim((string) $setting->getRecipientEmail()));
        }

        $hasUnavailableSteps = in_array(false, $mailEnabled, true);

        return $this->render('front/visual_identity_billing/index.html.twig', [
            'billings' => $billings,
            'mailEnabled' => $mailEnabled,
            'hasUnavailableSteps' => $hasUnavailableSteps,
        ]);
    }
}
