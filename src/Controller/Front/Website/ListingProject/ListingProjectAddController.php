<?php

namespace App\Controller\Front\Website\ListingProject;

use App\Entity\ListingProjects;
use App\Repository\CustomerRepository;
use App\Repository\ListingProjectsRepository;
use App\Repository\WebsiteProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Front\listingProjects\AddListingProjectsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListingProjectAddController extends AbstractController
{
    private $entityManager;
    private $websiteProjectRepo;
    private $listingProjectsRepo;
    private $customerRepo;
    public function __construct(EntityManagerInterface $entityManager, WebsiteProjectRepository $websiteProjectRepo, ListingProjectsRepository $listingProjectsRepo, CustomerRepository $customerRepo)
    {
        $this->entityManager = $entityManager;
        $this->websiteProjectRepo = $websiteProjectRepo;
        $this->listingProjectsRepo = $listingProjectsRepo;
        $this->customerRepo = $customerRepo;
    }


    #[Route("/liste-des-projets/ajouter", name: 'listing_projects_add')]
    public function listingProjectAdd(Request $request): Response
    {
        $listingCustomerAdd = new ListingProjects();
        $usedIds = array_values(array_filter(array_map(
            fn ($lp) => $lp->getCustomer()?->getId(),
            $this->listingProjectsRepo->findAll()
        )));
        $form = $this->createForm(AddListingProjectsType::class, $listingCustomerAdd, [
            'excluded_customer_ids' => $usedIds,
        ]);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $listingCustomerAdd->getCustomer();
            if ($customer) {
                $listingCustomerAdd->setEnterprise($customer->getEntreprise());
                $wp = $this->websiteProjectRepo->findOneBy(['customer' => $customer]);
                if ($wp && $wp->getDomainText()) {
                    $listingCustomerAdd->setDomainName($wp->getDomainText());
                }
            }

            $this->entityManager->persist($listingCustomerAdd);
            $this->entityManager->flush();
            $notification = "Le projet a été ajouté avec succès.";
            $listingCustomerAdd = new ListingProjects();
            $usedIds = array_values(array_filter(array_map(
                fn ($lp) => $lp->getCustomer()?->getId(),
                $this->listingProjectsRepo->findAll()
            )));
            $form = $this->createForm(AddListingProjectsType::class, $listingCustomerAdd, [
                'excluded_customer_ids' => $usedIds,
            ]);
        }
        $totalCustomers = count($this->customerRepo->findAll());
        $noAvailableCustomers = count($usedIds) >= $totalCustomers;
        return $this->render('front/listingProjects/add.html.twig', [
            'form_listingCustomer_add'  => $form->createView(),
            'notification'             => $notification,
            'no_available_customers'   => $noAvailableCustomers,
        ]);
    }
}