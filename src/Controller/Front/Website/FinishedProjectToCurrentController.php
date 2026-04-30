<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteProject;
use App\Repository\WebsiteProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FinishedProjectToCurrentController extends AbstractController
{
    #[Route("/basculer-vers-projets-en-cours/id={id}", name: 'tocurrentproject')]
    public function ChangeProjectsForInProgressProjectsFront(WebsiteProject $project, WebsiteProjectRepository $projectsRepository): Response
    {
        $projectsRepository->setChangeStepsForInProgressProjectsFront($project->getId());

        return $this->redirectToRoute("finished_projects");
    }
}