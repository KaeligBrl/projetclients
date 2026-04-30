<?php

namespace App\Controller\Back;

use App\Entity\WebsiteProject;
use App\Form\Back\Projects\AddProjectType;
use App\Form\Back\Projects\ModifyProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectsController extends AbstractController
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

    #[Route('projets-clients/supprimer/{id}', name: 'project_delete')]
    public function projectDeleteFront(WebsiteProject $projectDelete): RedirectResponse
    {
        $em = $this->entityManager;
        $em->remove($projectDelete);
        $em->flush();

        return $this->redirectToRoute('finished_projects');
    }

    #[Route('projet-sites-web/brief-client/{id}', name: 'project_customerbrief_checkbox')]
    public function projectCustomerbrief(WebsiteProject $projectCustomerbrief)
    {
        $projectCustomerbrief->setCustomerbrief(($projectCustomerbrief->getCustomerbrief()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectCustomerbrief);
        $em->flush();

        return new Response('true');
    }

    #[Route('projet-sites-web/coming-soon/{id}', name: 'project_comingsoon_checkbox')]
    public function projectComingsoon(WebsiteProject $projectComingsoon)
    {
        $projectComingsoon->setComingsoon(($projectComingsoon->getComingsoon()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectComingsoon);
        $em->flush();

        return new Response('true');
    }

    #[Route('projet-sites-web/reception-contenu-client/{id}', name: 'project_customercontentreception_checkbox')]
    public function projectCustomerContentReception(WebsiteProject $projectCustomercontentreception)
    {
        $projectCustomercontentreception->setCustomercontentreception(($projectCustomercontentreception->getCustomercontentreception()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectCustomercontentreception);
        $em->flush();

        return new Response('true');
    }

    #[Route('projet-sites-web/maquette-envoyee/{id}', name: 'project_webdesignsend_checkbox')]
    public function projectWebdesignWait(WebsiteProject $projectWebdesignSend)
    {
        $projectWebdesignSend->setWebdesignSend(($projectWebdesignSend->getWebdesignSend()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectWebdesignSend);
        $em->flush();

        return new Response('true');
    }

    #[Route('projet-sites-web/maquette-validee/{id}', name: 'project_webdesignvalidated_checkbox')]
    public function projectWebdesignValidated(WebsiteProject $projectWebdesignValidated)
    {
        $projectWebdesignValidated->setWebdesignvalidated(($projectWebdesignValidated->getWebdesignvalidated()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectWebdesignValidated);
        $em->flush();

        return new Response('true');
    }

    #[Route('projet-sites-web/nom-de-domaine/{id}', name: 'project_domainname_checkbox')]
    public function projectWDomainName(WebsiteProject $projectDomainname)
    {
        $projectDomainname->SetDomainname(($projectDomainname->getDomainname()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectDomainname);
        $em->flush();

        return new Response('true');
    }

    #[Route('projet-sites-web/integration/{id}', name: 'projects_integration_checkbox')]
    public function projectIntegration(WebsiteProject $projectWebintegration)
    {
        $projectWebintegration->setWebintegration(($projectWebintegration->getWebintegration()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectWebintegration);
        $em->flush();

        return new Response('true');
    }

    #[Route('projet-sites-web/formation/{id}', name: 'project_webtraining_checkbox')]
    public function projectWbeTraining(WebsiteProject $projectWebtraining)
    {
        $projectWebtraining->setWebTraining(($projectWebtraining->getWebtraining()) ? false : true);

        $em = $this->entityManager;
        $em->persist($projectWebtraining);
        $em->flush();

        return new Response('true');
    }
}






