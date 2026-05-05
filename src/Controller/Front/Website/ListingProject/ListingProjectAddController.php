<?php

namespace App\Controller\Front\Website\ListingProject;

use App\Entity\ListingProjects;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Front\listingProjects\AddListingProjectsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListingProjectAddController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route("/liste-des-projets/ajouter", name: 'listing_projects_add')]
    public function listingProjectAdd(Request $request): Response
    {
        $listingCustomerAdd = new ListingProjects();
        $form = $this->createForm(AddListingProjectsType::class, $listingCustomerAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($listingCustomerAdd);
            $this->entityManager->flush();
            $notification = "le client a Ã©tÃ© ajoutÃ©";
            $listingCustomerAdd = new ListingProjects();
            $form = $this->createForm(AddListingProjectsType::class, $listingCustomerAdd);
        }
        return $this->render('front/listingProjects/add.html.twig', [
            'form_listingCustomer_add' => $form->createView(),
            'notification' => $notification
        ]);
    }
}