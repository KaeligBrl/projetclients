<?php

namespace App\Controller\Front\VisualIdentity;

use App\Entity\VisualIdentityProject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityToFinishedController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/identite-visuelle/terminer/{id}', name: 'visual_identity_to_finished')]
    public function finish(VisualIdentityProject $project): Response
    {
        $project->setFinished(true);
        $this->entityManager->flush();

        return $this->redirectToRoute('visual_identity_project');
    }
}
