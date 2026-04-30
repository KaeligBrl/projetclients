<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteProject;
use App\Form\Front\WebsiteProject\AddWebsiteProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WebsiteProjectAddController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('projet-sites-web/ajouter', name: 'website_project_add')]
    public function projectsAdd(Request $request): Response
    {
        $projectAdd = new WebsiteProject();
        $form = $this->createForm(AddWebsiteProjectType::class, $projectAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($projectAdd);
            $this->entityManager->flush();
            $notification = "Le projet a été ajouté";
            $projectAdd = new WebsiteProject();
            $form = $this->createForm(AddWebsiteProjectType::class, $projectAdd);
        }
        return $this->render('front/projects/add.html.twig', [
            'form_project_add' => $form->createView(),
            'notification' => $notification,

        ]);
    }

}