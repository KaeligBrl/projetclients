<?php

namespace App\Controller\Back;

use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use App\Repository\WebsiteProjectRepository;
use App\Repository\WebsiteBillingRepository;
use App\Repository\VisualIdentityProjectRepository;
use App\Repository\VisualIdentityBillingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(
        CustomerRepository $customerRepository,
        UserRepository $userRepository,
        WebsiteProjectRepository $websiteProjectRepository,
        WebsiteBillingRepository $websiteBillingRepository,
        VisualIdentityProjectRepository $viProjectRepository,
        VisualIdentityBillingRepository $viBillingRepository,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $allWebProjects = $websiteProjectRepository->findAll();
        $allViProjects  = $viProjectRepository->findAll();

        $totalInProgress = count(array_filter($allWebProjects, fn($p) => !$p->getFinished()))
                         + count(array_filter($allViProjects,  fn($p) => !$p->getFinished()));

        $totalFinished   = count(array_filter($allWebProjects, fn($p) => $p->getFinished()))
                         + count(array_filter($allViProjects,  fn($p) => $p->getFinished()));

        $totalBillingSent = count(array_filter($websiteBillingRepository->findAll(), fn($b) => $b->getStatus()))
                          + count(array_filter($viBillingRepository->findAll(),      fn($b) => $b->getStatus()));

        return $this->render('back/dashboard/index.html.twig', [
            'totalCustomers'   => $customerRepository->count([]),
            'totalUsers'       => $userRepository->count([]),
            'totalInProgress'  => $totalInProgress,
            'totalFinished'    => $totalFinished,
            'totalBillingSent' => $totalBillingSent,
        ]);
    }
}
