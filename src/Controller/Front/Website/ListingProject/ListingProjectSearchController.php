<?php

namespace App\Controller\Front\Website\ListingProject;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ListingProjectsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListingProjectSearchController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/liste-des-projets/search", name: 'listing_projects_search', methods: ['GET'])]
    public function search(ListingProjectsRepository $listingProjectsRepository, Request $request): JsonResponse
    {
        $idsActivity  = array_filter(array_map('intval', (array) $request->query->all('activity')));
        $idsWebsite   = array_filter(array_map('intval', (array) $request->query->all('website')));
        $idsEnterprise= array_filter(array_map('intval', (array) $request->query->all('enterprise')));

        $rows = $listingProjectsRepository->findListingProjectByParam(
            $idsActivity ?: null,
            $idsWebsite  ?: null,
            $idsEnterprise?: null
        );

        return $this->json($rows);
    }

}