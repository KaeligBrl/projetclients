<?php

namespace App\Controller\Front\VisualIdentity;

use App\Entity\VisualIdentityProject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityToCurrentController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/identite-visuelle/en-cours/{id}', name: 'visual_identity_to_current')]
    public function toCurrent(VisualIdentityProject $project): Response
    {
        $project->setFinished(false);
        $this->entityManager->flush();

        return $this->redirectToRoute('visual_identity_finished');
    }
}
