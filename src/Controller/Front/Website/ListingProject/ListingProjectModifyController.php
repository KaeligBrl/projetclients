<?php

namespace App\Controller\Front\Website\ListingProject;

use App\Entity\ListingProjects;
use App\Repository\WebsiteProjectRepository;
use App\Form\Front\listingProjects\ModifyListingProjectsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListingProjectModifyController extends AbstractController
{
    private $entityManager;
    private $websiteProjectRepo;
    public function __construct(EntityManagerInterface $entityManager, WebsiteProjectRepository $websiteProjectRepo)
    {
        $this->entityManager = $entityManager;
        $this->websiteProjectRepo = $websiteProjectRepo;
    }


    #[Route("/liste-des-projets/modifier/{id}", name: 'listing_projects_modify')]
    public function listingProjectModify(Request $request, ListingProjects $listingProjectModify): Response
    {
        $form = $this->createForm(ModifyListingProjectsType::class, $listingProjectModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listingProjectModify = $form->getData();
            $customer = $listingProjectModify->getCustomer();
            if ($customer) {
                $listingProjectModify->setEnterprise($customer->getName());
                $wp = $this->websiteProjectRepo->findOneBy(['customer' => $customer]);
                if ($wp && $wp->getDomainText()) {
                    $listingProjectModify->setDomainName($wp->getDomainText());
                }
            }
            $this->entityManager->persist($listingProjectModify);
            $this->entityManager->flush();
            $notication = "Le projet a été mis à jour.";
            $listingProjectModify = new ListingProjects();
            $listingProjectModify = $form->getData($listingProjectModify);
            $form = $this->createForm(ModifyListingProjectsType::class, $listingProjectModify);
        }
        return $this->render('front/listingProjects/modify.html.twig', [
            'form_listing_project_modify' => $form->createView(),
            'notification' => $notication,
            'listingCustomer' => $listingProjectModify
        ]);
    }
}