<?php

namespace App\Controller\Front\VisualIdentity;

use App\Entity\VisualIdentityProject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisualIdentityCheckboxController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/identite-visuelle/brief-client/{id}', name: 'vi_checkbox_customer_brief')]
    public function toggleCustomerBrief(VisualIdentityProject $project): Response
    {
        $project->setCustomerBrief(!$project->getCustomerBrief());
        $this->entityManager->flush();
        return new Response('true');
    }

    #[Route('/identite-visuelle/prise-de-rdv/{id}', name: 'vi_checkbox_appointment')]
    public function toggleAppointment(VisualIdentityProject $project): Response
    {
        $project->setAppointmentScheduled(!$project->getAppointmentScheduled());
        $this->entityManager->flush();
        return new Response('true');
    }

    #[Route('/identite-visuelle/presentation/{id}', name: 'vi_checkbox_presentation')]
    public function togglePresentation(VisualIdentityProject $project): Response
    {
        $project->setPresentationDone(!$project->getPresentationDone());
        $this->entityManager->flush();
        return new Response('true');
    }

    #[Route('/identite-visuelle/retravail/{id}', name: 'vi_checkbox_rework')]
    public function toggleRework(VisualIdentityProject $project): Response
    {
        $project->setReworkDone(!$project->getReworkDone());
        $this->entityManager->flush();
        return new Response('true');
    }

    #[Route('/identite-visuelle/validation/{id}', name: 'vi_checkbox_validated')]
    public function toggleValidated(VisualIdentityProject $project): Response
    {
        $project->setValidated(!$project->getValidated());
        $this->entityManager->flush();
        return new Response('true');
    }

    #[Route('/identite-visuelle/declinaisons/{id}', name: 'vi_checkbox_declinations')]
    public function toggleDeclinations(VisualIdentityProject $project): Response
    {
        $project->setDeclinationsDone(!$project->getDeclinationsDone());
        $this->entityManager->flush();
        return new Response('true');
    }

    #[Route('/identite-visuelle/fichiers-livres/{id}', name: 'vi_checkbox_files_delivered')]
    public function toggleFilesDelivered(VisualIdentityProject $project): Response
    {
        $project->setFilesDelivered(!$project->getFilesDelivered());
        $this->entityManager->flush();
        return new Response('true');
    }
}
