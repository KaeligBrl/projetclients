<?php

namespace App\Controller\Front\VisualIdentity;

use App\Entity\VisualIdentityProject;
use App\Form\Front\VisualIdentity\AddVisualIdentityProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityAddController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/identite-visuelle/ajouter', name: 'visual_identity_add')]
    public function add(Request $request): Response
    {
        $project = new VisualIdentityProject();
        $form = $this->createForm(AddVisualIdentityProjectType::class, $project);
        $notification = null;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($project);
            $this->entityManager->flush();
            $notification = 'Le projet a été ajouté';
            $project = new VisualIdentityProject();
            $form = $this->createForm(AddVisualIdentityProjectType::class, $project);
        }

        return $this->render('front/visual_identity/add.html.twig', [
            'form_project_add' => $form->createView(),
            'notification' => $notification,
        ]);
    }
}
