<?php

namespace App\Controller\Front;


use App\Entity\Projects;

use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\Front\Task\ModifyTaskP1CurrentWeekType;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
            'project' => $projects->findBy(array(), array('customer' => 'DESC')),
        ]);
    }


    /**
     * @Route("/projet-en-cours/brief-client/{id}", name="steps_customerbrief_checkbox_admin")
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
     * @Route("/projet-en-cours/coming-soon/{id}", name="steps_comingsoon_checkbox_admin")
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
     * @Route("/projet-en-cours/reception-contenu-client/{id}", name="steps_customercontentreception_checkbox_admin")
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
     * @Route("/projet-en-cours/reception-des-photos/{id}", name="steps_picturesreception_checkbox_admin")
     */
    public function stepsPictureReception(Projects $stepsPicturesreception)
    {
        $stepsPicturesreception->setPicturesreception(($stepsPicturesreception->getPicturesreception()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepsPicturesreception);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/maquette-en-cours/{id}", name="steps_webdesignprogress_checkbox_admin")
     */
    public function stepsWebdesignProgress(Projects $stepWebdesignProgress)
    {
        $stepWebdesignProgress->setWebdesignprogress(($stepWebdesignProgress->getWebdesignprogress()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepWebdesignProgress);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/projet-en-cours/maquette-envoyee/{id}", name="steps_webdesignsend_checkbox_admin")
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
     * @Route("/projet-en-cours/maquette-validee/{id}", name="steps_webdesignvalidated_checkbox_admin")
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
     * @Route("/projet-en-cours/nom-de-domaine/{id}", name="steps_domainname_checkbox_admin")
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
     * @Route("/projet-en-cours/integration/{id}", name="steps_integration_checkbox_admin")
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
     * @Route("/projet-en-cours/formation/{id}", name="steps_webtraining_checkbox_admin")
     */
    public function stepsWbeTraining(Projects $stepWebtraining)
    {
        $stepWebtraining->setWebTraining(($stepWebtraining->getWebtraining()) ? false : true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepWebtraining);
        $em->flush();

        return new Response("true");
    }


}
