<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteProject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteProjectToFinishController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/basculer-vers-projets-finis/id={id}', name: 'finishedprojects')]
    public function ChangeStepsForFinishProjectsFront(WebsiteProject $projectsFinish): Response
    {
        $projectsFinish->setFinished(true);

        $em = $this->entityManager;
        $em->persist($projectsFinish);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
