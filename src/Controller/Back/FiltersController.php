<?php

namespace App\Controller\Back;

use App\Entity\Filters;
use App\Form\Back\Filters\AddFilterType;
use App\Form\Back\Filters\ModifyFilterType;
use App\Repository\FiltersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltersController extends AbstractController
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
     * @Route("filtres", name="filters")
     */
    public function index(FiltersRepository $filters): Response
    {

        return $this->render('back/filters/list.html.twig', [
            'filterslist' => $filters->findBy(array(), array('name' => 'ASC')),
        ]);
    }

    /**
     * @Route("filtres/ajouter", name="filter_add")
     */
    public function filterAdd(Request $request): Response
    {
        $filterAdd = new Filters();
        $form = $this->createForm(AddFilterType::class, $filterAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($filterAdd);
            $this->entityManager->flush();
            $notification = 'Le filtre a bien été ajouté';
            $filterAdd = new Filters();
            $form = $this->createForm(AddFilterType::class, $filterAdd);
        }
        return $this->render('back/filters/add.html.twig', [
            'form_filter_add' => $form->createView(),
            'notification' => $notification

        ]);
    }

    /**
     * @Route("filtre/modifier/{id}", name="filter_modify")
     */
    public function filterModify(Request $request, Filters $filterModify): Response
    {
        $form = $this->createForm(ModifyFilterType::class, $filterModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filterModify = $form->getData();
            $this->entityManager->persist($filterModify);
            $this->entityManager->flush();
            $notication = "Le filtre a été mis à jour";
            $filterModify = new Filters();
            $filterModify = $form->getData($filterModify);
            $form = $this->createForm(ModifyFilterType::class, $filterModify);
        }
        return $this->render('back/filters/modify.html.twig', [
            'form_filter_modify' => $form->createView(),
            'notification' => $notication,
            'filter' => $filterModify
        ]);
    }

    /**
     * @Route("filtre/supprimer?id={id}", name="filter_detete")
     * return RedirectResponse
     */
    public function filterDeleteAdmin(Filters $filterDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($filterDelete);
        $em->flush();

        return $this->redirectToRoute("filters");
    }
}