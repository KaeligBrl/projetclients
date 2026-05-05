<?php

namespace App\Controller\Front\Website\ListingProject;

use App\Entity\ListingProjects;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class ListingProjectDeleteController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route("/liste-des-projets/{id}/supprimer", name: 'listing_projects_detete')]
    public function listingProjectDelete(ListingProjects $listingProjectsDelete): RedirectResponse
    {
        $em = $this->entityManager;
        $em->remove($listingProjectsDelete);
        $em->flush();

        return $this->redirectToRoute("listing_projects");
    }
}