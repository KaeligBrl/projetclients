<?php

namespace App\Controller\Back;

use App\Entity\FiltersEnterprises;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FiltersEnterprisesRepository;
use App\Form\Back\Filters\Enterprises\AddFilterType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Back\Filters\Enterprises\ModifyFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltersEnterprisesController extends AbstractController
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
     * @Route("filtre/entreprises", name="filters_enterprises")
     */
    public function index(FiltersEnterprisesRepository $filters): Response
    {

        return $this->render('back/filters/enterprises/list.html.twig', [
            'filterslist' => $filters->findby([], ['nameEnterprises' => "ASC"]),
        ]);
    }

    /**
     * @Route("filtre/entreprises/ajouter", name="filter_enterprise_add")
     */
    public function filterEnterpriseAdd(Request $request): Response
    {
        $filterEnterpriseAdd = new FiltersEnterprises();
        $form = $this->createForm(AddFilterType::class, $filterEnterpriseAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($filterEnterpriseAdd);
            $this->entityManager->flush();
            $notification = 'Le filtre a bien été ajouté';
            $filterEnterpriseAdd = new FiltersEnterprises();
            $form = $this->createForm(AddFilterType::class, $filterEnterpriseAdd);
        }
        return $this->render('back/filters/enterprises/add.html.twig', [
            'form_filter_enterprise_add' => $form->createView(),
            'notification' => $notification

        ]);
    }

    /**
     * @Route("filtre/entreprise/modifier/{id}", name="filter_enterprise_modify")
     */
    public function filterWebsiteModify(Request $request, FiltersEnterprises $filtersEnterprisesModify): Response
    {
        $form = $this->createForm(ModifyFilterType::class, $filtersEnterprisesModify);
        $notication = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filtersEnterprisesModify = $form->getData();
            $this->entityManager->persist($filtersEnterprisesModify);
            $this->entityManager->flush();
            $notication = "Le filtre a été mis à jour";
            $filtersEnterprisesModify = new FiltersEnterprises();
            $filtersEnterprisesModify = $form->getData($filtersEnterprisesModify);
            $form = $this->createForm(ModifyFilterType::class, $filtersEnterprisesModify);
        }
        return $this->render('back/filters/enterprises/modify.html.twig', [
            'form_filter_enterprise_modify' => $form->createView(),
            'notification' => $notication,
            'filterEnterprise' => $filtersEnterprisesModify
        ]);
    }

    /**
     * @Route("filtre/entreprise/supprimer/{id}", name="filter_enterprise_detete")
     * return RedirectResponse
     */
    public function filterDeleteAdmin(filtersEnterprises $filterEnterpriseDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($filterEnterpriseDelete);
        $em->flush();

        return $this->redirectToRoute("filters_enterprises");
    }
}