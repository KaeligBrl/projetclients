<?php

namespace App\Controller\Front\VisualIdentity;

use App\Repository\VisualIdentityProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityController extends AbstractController
{
    #[Route('/identite-visuelle', name: 'visual_identity_project')]
    public function index(VisualIdentityProjectRepository $projects): Response
    {
        return $this->render('front/visual_identity/index.html.twig', [
            'projects' => $projects->findBy([], ['id' => 'ASC']),
        ]);
    }
}
