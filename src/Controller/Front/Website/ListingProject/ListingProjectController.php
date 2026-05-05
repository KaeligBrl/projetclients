<?php

namespace App\Controller\Front\Website\ListingProject;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FiltersWebsitesRepository;
use App\Repository\ListingProjectsRepository;
use App\Repository\FilterEnterpriseRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\FiltersActivitiesRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListingProjectController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/liste-des-projets", name: 'listing_projects')]
    public function index(ListingProjectsRepository $listingProjectsRepository, FiltersActivitiesRepository $filters, FiltersWebsitesRepository $filtersWebsites, FilterEnterpriseRepository $filtersEnterprises): Response
    {
        $count = $listingProjectsRepository->count([]);

        return $this->render('front/listingProjects/list.html.twig', [
            'filters'          => $filters->findBy([], ['nameActivities' => 'ASC']),
            'filterWebsites'   => $filtersWebsites->findBy([], ['nameWebsites' => 'ASC']),
            'filterEnterprises'=> $filtersEnterprises->findBy([], ['nameEnterpriseType' => 'ASC']),
            'project_count'    => $count,
        ]);
    }

}