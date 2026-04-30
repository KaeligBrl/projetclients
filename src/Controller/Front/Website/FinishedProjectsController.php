<?php

namespace App\Controller\Front\Website;

use App\Repository\WebsiteProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class FinishedProjectsController extends AbstractController
{
    #[Route("/projets-finis", name: 'finished_projects')]
    public function index(WebsiteProjectRepository $projects)
    {
        return $this->render('front/website_project/finished.html.twig', [
            'projects' => $projects->findBy(array(), array('online' => 'DESC')),
        ]);
    }
}