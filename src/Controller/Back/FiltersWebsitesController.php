<?php

namespace App\Controller\Back;

use App\Entity\FiltersWebsites;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FiltersWebsitesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Back\Filters\Websites\AddFilterType;
use App\Form\Back\Filters\Websites\ModifyFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltersWebsitesController extends AbstractController
/**
* @Route("/admin/")
*/
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("filtre/types-de-site", name="filters_websites_types")
     */
    public function index(FiltersWebsitesRepository $filters): Response
    {

        return $this->render('back/filters/websites/list.html.twig', [
            'filterslist' => $filters->findby([], ['nameWebsites' => "ASC"]),
        ]);
    }

    /**
     * @Route("filtre/types-de-site/ajouter", name="filter_website_type_add")
     */
    public function filterWebsiteAdd(Request $request): Response
    {
        $filterWebsiteAdd = new FiltersWebsites();
        $form = $this->createForm(AddFilterType::class, $filterWebsiteAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($filterWebsiteAdd);
            $this->entityManager->flush();
            $notification = 'Le filtre a bien été ajouté';
            $filterWebsiteAdd = new FiltersWebsites();
            $form = $this->createForm(AddFilterType::class, $filterWebsiteAdd);
        }
        return $this->render('back/filters/websites/add.html.twig', [
            'form_filter_website_type_add' => $form->createView(),
            'notification' => $notification

        ]);
    }

    /**
     * @Route("filtre/types-de-site/modifier/{id}", name="filter_website_type_modify")
     */
    public function filterWebsiteModify(Request $request, FiltersWebsites $filtersWebsitesModify): Response
    {
        $form = $this->createForm(ModifyFilterType::class, $filtersWebsitesModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filtersWebsitesModify = $form->getData();
            $this->entityManager->persist($filtersWebsitesModify);
            $this->entityManager->flush();
            $notication = "Le filtre a été mis à jour";
            $filtersWebsitesModify = new FiltersWebsites();
            $filtersWebsitesModify = $form->getData($filtersWebsitesModify);
            $form = $this->createForm(ModifyFilterType::class, $filtersWebsitesModify);
        }
        return $this->render('back/filters/websites/modify.html.twig', [
            'form_filter_website_type_modify' => $form->createView(),
            'notification' => $notication,
            'filterWebsite' => $filtersWebsitesModify
        ]);
    }

    /**
     * @Route("filtre/types-de-site/supprimer/{id}", name="filter_website_type_detete")
     * return RedirectResponse
     */
    public function filterDeleteAdmin(FiltersWebsites $filterWebsitesDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($filterWebsitesDelete);
        $em->flush();

        return $this->redirectToRoute("filters_websites_types");
    }
}