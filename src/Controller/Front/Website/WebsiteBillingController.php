<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteBilling;
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
    ): Response {
        $projects = $projectRepository->findBy([], ['id' => 'ASC']);

        foreach ($projects as $project) {
            $billing = $billingRepository->findOneBy(['websiteProject' => $project]);
            if (!$billing) {
                $billing = new WebsiteBilling();
                $billing->setWebsiteProject($project);
                $billing->setLabel($project->getCustomer()?->getName() ?? '');
                $this->entityManager->persist($billing);
            }
        }
        $this->entityManager->flush();

        $billings = $billingRepository->findBy([], ['id' => 'ASC']);

        return $this->render('front/website_billing/index.html.twig', [
            'billings' => $billings,
        ]);
    }
}
