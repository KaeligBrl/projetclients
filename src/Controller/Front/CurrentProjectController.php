<?php

namespace App\Controller\Front;


use App\Entity\Projects;

use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CurrentProjectController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/projet-en-cours", name="current_project")
     */
    public function index(ProjectsRepository $projects): Response
    {

        return $this->render('front/current/index.html.twig', [
            'projects' => $projects->findBy(array(), array('customer' => 'DESC')),
        ]);
    }


    /**
     * @Route("/projet-en-cours/brief-client/{id}", name="current_project_customerbrief_checkbox")
     */
    public function stepsCustomerbrief(Projects $stepsCustomerbrief)
    {
        $stepsCustomerbrief->setCustomerbrief(($stepsCustomerbrief->getCustomerbrief()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepsCustomerbrief);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/coming-soon/{id}", name="current_project_comingsoon_checkbox")
     */
    public function stepsComingsoon(Projects $stepsComingsoon)
    {
        $stepsComingsoon->setComingsoon(($stepsComingsoon->getComingsoon()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepsComingsoon);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/reception-contenu-client/{id}", name="current_project_customercontentreception_checkbox")
     */
    public function stepsCustomerContentReception(Projects $stepsCustomercontentreception)
    {
        $stepsCustomercontentreception->setCustomercontentreception(($stepsCustomercontentreception->getCustomercontentreception()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepsCustomercontentreception);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/maquette-envoyee/{id}", name="current_project_webdesignsend_checkbox")
     */
    public function stepsWebdesignWait(Projects $stepWebdesignSend)
    {
        $stepWebdesignSend->setWebdesignSend(($stepWebdesignSend->getWebdesignSend()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepWebdesignSend);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/maquette-validee/{id}", name="current_projectwebdesignvalidated_checkbox")
     */
    public function stepsWebdesignValidated(Projects $stepWebdesignValidated)
    {
        $stepWebdesignValidated->setWebdesignvalidated(($stepWebdesignValidated->getWebdesignvalidated()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepWebdesignValidated);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/nom-de-domaine/{id}", name="current_project_domainname_checkbox")
     */
    public function stepsWDomainName(Projects $stepDomainname)
    {
        $stepDomainname->SetDomainname(($stepDomainname->getDomainname()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepDomainname);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/integration/{id}", name="current_project_integration_checkbox")
     */
    public function stepsIntegration(Projects $stepWebintegration)
    {
        $stepWebintegration->setWebintegration(($stepWebintegration->getWebintegration()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepWebintegration);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/formation/{id}", name="current_project_webtraining_checkbox")
     */
    public function stepsWbeTraining(Projects $stepWebtraining)
    {
        $stepWebtraining->setWebTraining(($stepWebtraining->getWebtraining()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepWebtraining);
        $em->flush();

        return new Response("true");
    }


    /**
     * @Route("/basculer-vers-projets-finis/id={id}", name="finishedprojects")
     */
    public function ChangeStepsForFinishProjectsFront(Projects $projectsFinish): Response
    {
        $projectsFinish->setFinished(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projectsFinish);
        $em->flush();

        return $this->redirectToRoute("home");
    }

}
