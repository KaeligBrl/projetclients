<?php

namespace App\Controller\Front\VisualIdentity;

use App\Repository\VisualIdentityProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityFinishedController extends AbstractController
{
    #[Route('/identite-visuelle/projets-finis', name: 'visual_identity_finished')]
    public function index(VisualIdentityProjectRepository $projects): Response
    {
        return $this->render('front/visual_identity/finished.html.twig', [
            'projects' => $projects->findBy(['finished' => true], ['id' => 'ASC']),
        ]);
    }
}
