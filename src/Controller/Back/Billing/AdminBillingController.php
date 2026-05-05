<?php

namespace App\Controller\Back\Billing;

use App\Repository\VisualIdentityBillingRepository;
use App\Repository\WebsiteBillingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminBillingController extends AbstractController
{
    #[Route('/admin/facturation', name: 'admin_billing')]
    public function index(
        WebsiteBillingRepository $websiteBillingRepo,
        VisualIdentityBillingRepository $viBillingRepo,
        Request $request,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Seuls les projets transmis au service admin (status = true)
        $websiteBillings = $websiteBillingRepo->findBy(['status' => true], ['id' => 'DESC']);
        $viBillings      = $viBillingRepo->findBy(['status' => true], ['id' => 'DESC']);

        return $this->render('back/billing/index.html.twig', [
            'websiteBillings' => $websiteBillings,
            'viBillings'      => $viBillings,
            'activeTab'       => $request->query->get('tab', 'website'),
        ]);
    }
}
