<?php

namespace App\Controller\Front\VisualIdentity;

use App\Entity\VisualIdentityProject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityDeleteController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/identite-visuelle/supprimer/{id}', name: 'visual_identity_delete')]
    public function delete(VisualIdentityProject $project): RedirectResponse
    {
        $this->entityManager->remove($project);
        $this->entityManager->flush();

        return $this->redirectToRoute('visual_identity_project');
    }
}
