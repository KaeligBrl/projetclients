<?php

namespace App\Controller\Front\Website\ListingProject;

use App\Entity\FiltersActivities;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListingProjectActivityFilterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/liste-des-projets/filtre/activite", name: 'listing_filter_create_activity', methods: ['POST'])]
    public function createFilterActivity(Request $request): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $name = trim((string) $request->request->get('name', ''));
        if ($name === '' || mb_strlen($name) > 50) {
            return $this->json(['error' => 'Nom invalide'], 422);
        }
        $entity = new FiltersActivities();
        $entity->setNameActivities($name);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $this->json(['id' => $entity->getId(), 'name' => $entity->getNameActivities()], 201);
    }

}





