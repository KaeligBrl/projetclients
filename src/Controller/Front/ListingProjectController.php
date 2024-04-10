<?php

namespace App\Controller\Front;

use App\Entity\ListingProjects;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FiltersWebsitesRepository;
use App\Repository\ListingProjectsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\FiltersActivitiesRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FilterEnterpriseRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\listingProjects\AddListingProjectsType;
use App\Form\Front\listingProjects\ModifyListingProjectsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListingProjectController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/liste-des-projets", name="listing_projects")
     */
    public function index(ListingProjectsRepository $listingProjectsRepository, FiltersActivitiesRepository $filters, FiltersWebsitesRepository $filtersWebsites, FilterEnterpriseRepository $filtersEnterprises, Request $request): Response
    {
        $listingProjects = $listingProjectsRepository->findListingProjectByParam($request->get('filters'), $request->get('filtersFa'),$request->get('filtersFe'));
        return $this->render('front/listingProjects/list.html.twig', [
            'listingProjects' => $listingProjects,
            'filters' => $filters->findBy([], ['nameActivities' => 'ASC']),
            'filterWebsites' => $filtersWebsites->findBy([], ['nameWebsites' => 'ASC']),
            'filterEnterprises' => $filtersEnterprises->findBy([], ['nameEnterpriseType' => 'ASC']),
            'currentFilters' => $request->get('filters'),
            'currentFiltersFa' => $request->get('filtersFa'),
            'currentFiltersFe' => $request->get('filtersFe')
        ]);
    }

    /**
     * @Route("/liste-des-projets/ajouter", name="listing_projects_add")
     */
    public function listingProjectAdd(Request $request): Response
    {
        $listingCustomerAdd = new ListingProjects();
        $form = $this->createForm(AddListingProjectsType::class, $listingCustomerAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($listingCustomerAdd);
            $this->entityManager->flush();
            $notification = "le client a été ajouté";
            $listingCustomerAdd = new ListingProjects();
            $form = $this->createForm(AddListingProjectsType::class, $listingCustomerAdd);
        }
        return $this->render('front/listingProjects/add.html.twig', [
            'form_listingCustomer_add' => $form->createView(),
            'notification' => $notification
        ]);
    }

    /**
     * @Route("/liste-des-projets/modifier/{id}", name="listing_projects_modify")
     */
    public function listingProjectModify(Request $request, ListingProjects $listingProjectModify): Response
    {
        $form = $this->createForm(ModifyListingProjectsType::class, $listingProjectModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listingProjectModify = $form->getData();
            $this->entityManager->persist($listingProjectModify);
            $this->entityManager->flush();
            $notication = "Le client a été mis à jour";
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

    /**
     * @Route("/liste-des-projets/{id}/supprimer", name="listing_projects_detete")
     */
    public function listingProjectDelete(ListingProjects $listingProjectsDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($listingProjectsDelete);
        $em->flush();

        return $this->redirectToRoute("listing_projects");
    }

}