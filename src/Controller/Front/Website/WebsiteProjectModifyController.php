<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteProject;
use App\Form\Front\WebsiteProject\ModifyWebsiteProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WebsiteProjectModifyController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('projet-sites-web/modifier/{id}', name: 'project_modify')]
    public function projectModify(Request $request, WebsiteProject $projectModify): Response
    {
        $form = $this->createForm(ModifyWebsiteProjectType::class, $projectModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectModify = $form->getData();
            $this->entityManager->persist($projectModify);
            $this->entityManager->flush();
            $notication = "Projet mis à jour !";
            $projectModify = new WebsiteProject();
            $projectModify = $form->getData($projectModify);
            $form = $this->createForm(ModifyWebsiteProjectType::class, $projectModify);
      
        }
        return $this->render('front/projects/modify.html.twig', [
            'form_project_modify' => $form->createView(),
            'notification' => $notication,
            'project' => $projectModify
        ]);
    }

}