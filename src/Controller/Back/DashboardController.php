<?php

namespace App\Controller\Back;

use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use App\Repository\WebsiteProjectRepository;
use App\Repository\WebsiteBillingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(
        CustomerRepository $customerRepository,
        UserRepository $userRepository,
        WebsiteProjectRepository $projectRepository,
        WebsiteBillingRepository $billingRepository,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $allProjects = $projectRepository->findAll();
        $totalInProgress = count(array_filter($allProjects, fn($p) => !$p->getFinished()));
        $totalFinished   = count(array_filter($allProjects, fn($p) => $p->getFinished()));

        $totalBillingSent = count(array_filter(
            $billingRepository->findAll(),
            fn($b) => $b->getStatus()
        ));

        return $this->render('back/dashboard/index.html.twig', [
            'totalCustomers'   => $customerRepository->count([]),
            'totalUsers'       => $userRepository->count([]),
            'totalInProgress'  => $totalInProgress,
            'totalFinished'    => $totalFinished,
            'totalBillingSent' => $totalBillingSent,
        ]);
    }
}
