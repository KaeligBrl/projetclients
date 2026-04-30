<?php

namespace App\Controller\Front;

use App\Entity\WebsiteProject;
use App\Repository\WebsiteProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FinishedProjectsController extends AbstractController
{
#[Route("/projets-finis", name: 'finished_projects')]
public function index2(WebsiteProjectRepository $projects)
    {
        return $this->render('front/finish/index.html.twig', [
            'projects' => $projects->findBy(array(), array('online' => 'DESC')),
        ]);
    }
#[Route("/basculer-vers-projets-en-cours/id={id}", name: 'tocurrentproject')]
public function ChangeProjectsForInProgressProjectsFront(WebsiteProject $project, WebsiteProjectRepository $projectsRepository): Response
    {
        $projectsRepository->setChangeStepsForInProgressProjectsFront($project->getId());

        return $this->redirectToRoute("finished_projects");
    }
}





