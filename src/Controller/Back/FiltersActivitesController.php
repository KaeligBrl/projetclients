<?php

namespace App\Controller\Back;

use App\Entity\FiltersActivities;
use App\Form\Back\Filters\Activities\AddFilterType;
use App\Form\Back\Filters\Activities\ModifyFilterType;
use App\Repository\FiltersActivitiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltersActivitesController extends AbstractController
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
     * @Route("filtres/activites", name="filters_activities")
     */
    public function index(FiltersActivitiesRepository $filters): Response
    {

        return $this->render('back/filters/activities/list.html.twig', [
            'filterslist' => $filters->findBy(array(), array('name' => 'ASC')),
        ]);
    }

    /**
     * @Route("filtres/activite/ajouter", name="filter_activitie_add")
     */
    public function filterAdd(Request $request): Response
    {
        $filterAdd = new FiltersActivities();
        $form = $this->createForm(AddFilterType::class, $filterAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($filterAdd);
            $this->entityManager->flush();
            $notification = 'Le filtre a bien été ajouté';
            $filterAdd = new FiltersActivities();
            $form = $this->createForm(AddFilterType::class, $filterAdd);
        }
        return $this->render('back/filters/activities/add.html.twig', [
            'form_filter_add' => $form->createView(),
            'notification' => $notification

        ]);
    }

    /**
     * @Route("filtre/activite/modifier/{id}", name="filter_activitie_modifiy")
     */
    public function filterModify(Request $request, FiltersActivities $filterModify): Response
    {
        $form = $this->createForm(ModifyFilterType::class, $filterModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filterModify = $form->getData();
            $this->entityManager->persist($filterModify);
            $this->entityManager->flush();
            $notication = "Le filtre a été mis à jour";
            $filterModify = new FiltersActivities();
            $filterModify = $form->getData($filterModify);
            $form = $this->createForm(ModifyFilterType::class, $filterModify);
        }
        return $this->render('back/filters/activities/modify.html.twig', [
            'form_filter_modify' => $form->createView(),
            'notification' => $notication,
            'filter' => $filterModify
        ]);
    }

    /**
     * @Route("filtre/activite/supprimer/{id}", name="filter_activitie_detete")
     * return RedirectResponse
     */
    public function filterDeleteAdmin(FiltersActivities $filterDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($filterDelete);
        $em->flush();

        return $this->redirectToRoute("filters_activities");
    }
}