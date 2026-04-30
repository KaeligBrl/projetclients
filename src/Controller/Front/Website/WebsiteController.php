<?php

namespace App\Controller\Front\Website;

use App\Entity\WebsiteProject;
use App\Repository\WebsiteProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/projet-sites-web', name: 'website_project')]
    public function index(WebsiteProjectRepository $projects): Response
    {
        return $this->render('front/website_project/index.html.twig', [
            'projects' => $projects->findBy(array(), array('customer' => 'DESC')),
        ]);
    }
}
