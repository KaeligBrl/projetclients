<?php

namespace App\Controller\Front\Website\ListingProject;

use App\Entity\FilterEnterprise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ListingProjectEnterpriseFilterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/liste-des-projets/filtre/entreprise", name: 'listing_filter_create_enterprise', methods: ['POST'])]
    public function createFilterEnterprise(Request $request): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $name = trim((string) $request->request->get('name', ''));
        if ($name === '' || mb_strlen($name) > 50) {
            return $this->json(['error' => 'Nom invalide'], 422);
        }
        $entity = new FilterEnterprise();
        $entity->setNameEnterpriseType($name);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $this->json(['id' => $entity->getId(), 'name' => $entity->getNameEnterpriseType()], 201);
    }

}