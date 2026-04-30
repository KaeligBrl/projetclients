<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteProject;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CheckboxWebsiteProjectController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/projet-sites-web/brief-client/{id}", name: 'website_project_customerbrief_checkbox')]
    public function stepsCustomerbrief(WebsiteProject $stepsCustomerbrief)
    {
        $stepsCustomerbrief->setCustomerbrief(($stepsCustomerbrief->getCustomerbrief()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepsCustomerbrief);
        $em->flush();

        return new Response('true');
    }

    #[Route('/projet-sites-web/coming-soon/{id}', name: 'website_project_comingsoon_checkbox')]
    public function stepsComingsoon(WebsiteProject $stepsComingsoon)
    {
        $stepsComingsoon->setComingsoon(($stepsComingsoon->getComingsoon()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepsComingsoon);
        $em->flush();

        return new Response('true');
    }

    #[Route('/projet-sites-web/reception-contenu-client/{id}', name: 'website_project_customercontentreception_checkbox')]
    public function stepsCustomerContentReception(WebsiteProject $stepsCustomercontentreception)
    {
        $stepsCustomercontentreception->setCustomercontentreception(($stepsCustomercontentreception->getCustomercontentreception()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepsCustomercontentreception);
        $em->flush();

        return new Response('true');
    }

    #[Route('/projet-sites-web/maquette-envoyee/{id}', name: 'website_project_webdesignsend_checkbox')]
    public function stepsWebdesignWait(WebsiteProject $stepWebdesignSend)
    {
        $stepWebdesignSend->setWebdesignSend(($stepWebdesignSend->getWebdesignSend()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepWebdesignSend);
        $em->flush();

        return new Response('true');
    }

    #[Route('/projet-sites-web/maquette-validee/{id}', name: 'website_projectwebdesignvalidated_checkbox')]
    public function stepsWebdesignValidated(WebsiteProject $stepWebdesignValidated)
    {
        $stepWebdesignValidated->setWebdesignvalidated(($stepWebdesignValidated->getWebdesignvalidated()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepWebdesignValidated);
        $em->flush();

        return new Response('true');
    }

    #[Route('/projet-sites-web/nom-de-domaine/{id}', name: 'website_project_domainname_checkbox')]
    public function stepsWDomainName(WebsiteProject $stepDomainname)
    {
        $stepDomainname->SetDomainname(($stepDomainname->getDomainname()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepDomainname);
        $em->flush();

        return new Response('true');
    }

    #[Route('/projet-sites-web/integration/{id}', name: 'website_project_integration_checkbox')]
    public function stepsIntegration(WebsiteProject $stepWebintegration)
    {
        $stepWebintegration->setWebintegration(($stepWebintegration->getWebintegration()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepWebintegration);
        $em->flush();

        return new Response('true');
    }

    #[Route('/projet-sites-web/formation/{id}', name: 'website_project_webtraining_checkbox')]
    public function stepsWebTraining(WebsiteProject $stepWebtraining)
    {
        $stepWebtraining->setWebTraining(($stepWebtraining->getWebTraining()) ? false : true);

        $em = $this->entityManager;
        $em->persist($stepWebtraining);
        $em->flush();

        return new Response('true');
    }
}