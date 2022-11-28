<?php

namespace App\Controller\Back;

use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use App\Form\Back\Projects\AddProjectType;
use App\Form\Back\Projects\ModifyProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectsController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("projet-en-cours/ajouter", name="project_add")
     */
    public function projectsAdd(Request $request): Response
    {
        $projectAdd = new Projects();
        $form = $this->createForm(AddProjectType::class, $projectAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($projectAdd);
            $this->entityManager->flush();
            $notification = "Le projet a été ajouté";
            $projectAdd = new Projects();
            $form = $this->createForm(AddProjectType::class, $projectAdd);
        }
        return $this->render('front/projects/add.html.twig', [
            'form_project_add' => $form->createView(),
            'notification' => $notification,

        ]);
    }

    /**
     * @Route("projet-en-cours/modifier/{id}", name="project_modify")
     */
    public function projectModify(Request $request, Projects $projectModify): Response
    {
        $form = $this->createForm(ModifyProjectType::class, $projectModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectModify = $form->getData();
            $this->entityManager->persist($projectModify);
            $this->entityManager->flush();
            $notication = "Projet mis à jour !";
            $projectModify = new Projects();
            $projectModify = $form->getData($projectModify);
            $form = $this->createForm(ModifyProjectType::class, $projectModify);
        }
        return $this->render('front/projects/modify.html.twig', [
            'form_project_modify' => $form->createView(),
            'notification' => $notication,
            'project' => $projectModify
        ]);
    }

    /**
     * @Route("projets-clients/supprimer/{id}", name="project_detete")
     * @param Projects $projectsDelete
     * return RedirectResponse
     */
    public function projectDeleteFront(Projects $projectDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($projectDelete);
        $em->flush();

        return $this->redirectToRoute("current_project");
    }

    /**
     * @Route("projet-en-cours/brief-client/{id}", name="project_customerbrief_checkbox")
     */
    public function projectCustomerbrief(Projects $projectCustomerbrief)
    {
        $projectCustomerbrief->setCustomerbrief(($projectCustomerbrief->getCustomerbrief())? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectCustomerbrief);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/coming-soon/{id}", name="project_comingsoon_checkbox")
     */
    public function projectComingsoon(Projects $projectComingsoon)
    {
        $projectComingsoon->setComingsoon(($projectComingsoon->getComingsoon()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectComingsoon);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/reception-contenu-client/{id}", name="project_customercontentreception_checkbox")
     */
    public function projectCustomerContentReception(Projects $projectCustomercontentreception)
    {
        $projectCustomercontentreception->setCustomercontentreception(($projectCustomercontentreception->getCustomercontentreception()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectCustomercontentreception);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/reception-des-photos/{id}", name="project_picturesreception_checkbox")
     */
    public function projectPictureReception(Projects $projectPicturesreception)
    {
        $projectPicturesreception->setPicturesreception(($projectPicturesreception->getPicturesreception()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectPicturesreception);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/maquette-en-cours/{id}", name="projects_webdesignprogress_checkbox")
     */
    public function projectWebdesignProgress(Projects $projectWebdesignProgress)
    {
        $projectWebdesignProgress->setWebdesignprogress(($projectWebdesignProgress->getWebdesignprogress()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectWebdesignProgress);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/maquette-envoyee/{id}", name="project_webdesignsend_checkbox")
     */
    public function projectWebdesignWait(Projects $projectWebdesignSend)
    {
        $projectWebdesignSend->setWebdesignSend(($projectWebdesignSend->getWebdesignSend()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectWebdesignSend);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/maquette-validee/{id}", name="project_webdesignvalidated_checkbox")
     */
    public function projectWebdesignValidated(Projects $projectWebdesignValidated)
    {
        $projectWebdesignValidated->setWebdesignvalidated(($projectWebdesignValidated->getWebdesignvalidated()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectWebdesignValidated);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/nom-de-domaine/{id}", name="project_domainname_checkbox")
     */
    public function projectWDomainName(Projects $projectDomainname)
    {
        $projectDomainname->SetDomainname(($projectDomainname->getDomainname()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectDomainname);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/integration/{id}", name="projects_integration_checkbox")
     */
    public function projectIntegration(Projects $projectWebintegration)
    {
        $projectWebintegration->setWebintegration(($projectWebintegration->getWebintegration()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectWebintegration);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("projet-en-cours/formation/{id}", name="project_webtraining_checkbox")
     */
    public function projectWbeTraining(Projects $projectWebtraining)
    {
        $projectWebtraining->setWebTraining(($projectWebtraining->getWebtraining()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectWebtraining);
        $em->flush();

        return new Response("true");
    }

}
