<?php

namespace App\Controller\Front;

use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;

class FinishedProjectsController extends AbstractController
{

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    /**
     * @Route("/projets-finis", name="finished_projects")
     */
    public function index2(ProjectsRepository $projects)
    {
        return $this->render('front/finish/index.html.twig', [
            'projects' => $projects->findBy(array(), array('finished' => 'DESC')),
        ]);
    }

    /**
     * @Route("/basculer-vers-projets-en-cours/id={id}", name="tocurrentproject")
     */
    public function ChangeProjectsForInProgressProjectsFront(Projects $project): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Projects::class)
            ->setChangeStepsForInProgressProjectsFront($project->getId());

        return $this->redirectToRoute("finished_projects");
    }

    /**
     * @Route("/projet-finis-/mail/id={id}", name="finish_project_mail")
     */
    public function sendMail(Projects $projectMail): Response
    {
        $message = (new TemplatedEmail())
            ->to('support@shebam.fr')
            ->from(new Address('support@shebam.fr', 'Support WEB Shebam'))
            ->cc('support@shebam.fr')
            ->subject('Site Internet Fini')
            ->htmlTemplate('front/mail/mail-project.html.twig')
            ->context([
                'project' => $projectMail
            ]);
        $this->mailer->send($message);

        return $this->redirectToRoute("home");
    }
}