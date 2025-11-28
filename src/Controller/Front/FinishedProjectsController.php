<?php

namespace App\Controller\Front;

use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FinishedProjectsController extends AbstractController
{
    /**
        * @Route("/projets-finis", name="finished_projects")
     */
    public function index2(ProjectsRepository $projects)
    {
        return $this->render('front/finish/index.html.twig', [
            'projects' => $projects->findBy(array(), array('online' => 'DESC')),
        ]);
    }

    /**
     * @Route("/basculer-vers-projets-en-cours/id={id}", name="tocurrentproject")
     */
    public function ChangeProjectsForInProgressProjectsFront(Projects $project, ProjectsRepository $projectsRepository): Response
    {
        $projectsRepository->setChangeStepsForInProgressProjectsFront($project->getId());

        return $this->redirectToRoute("finished_projects");
    }
}