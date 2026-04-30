<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteProject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class WebsiteProjectDeleteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('projets-clients/supprimer/{id}', name: 'project_delete')]
    public function projectDeleteFront(WebsiteProject $projectDelete): RedirectResponse
    {
        $em = $this->entityManager;
        $em->remove($projectDelete);
        $em->flush();

        return $this->redirectToRoute('website_projects_finished');
    }

}