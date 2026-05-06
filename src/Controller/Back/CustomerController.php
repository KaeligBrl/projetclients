<?php

namespace App\Controller\Back;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Customer\AddCustomerType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Back\Customer\ModifyCustomerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/')]
class CustomerController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('clients', name: 'list_customer')]
    public function listCustomers(CustomerRepository $customerAdmin): Response
    {
        $em = $this->entityManager;
        $repoCustomer = $em->getRepository(Customer::class);
        $totalCustomer = $repoCustomer->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('back/customer/list.html.twig', [
            'customer' => $customerAdmin->findBy(array(), array('entreprise' => 'ASC')),
            'totalCustomer' => $totalCustomer
        ]);
    }

    #[Route('client/ajouter', name: 'add_customer')]
    public function index(Request $request): Response
    {
        $customerAdd = new Customer();
        $form = $this->createForm(AddCustomerType::class, $customerAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($customerAdd);
            $this->entityManager->flush();
            $notification = 'Le client a bien été ajouté.';
            $customerAdd = new Customer();
            $form = $this->createForm(AddCustomerType::class, $customerAdd);
        }

        return $this->render('back/customer/add.html.twig', [
            'form_customer_add' => $form->createView(),
            'notification' => $notification
        ]);
    }

    #[Route('client/{id}/supprimer', name: 'delete_customer')]
    public function deleteStatut(Customer $customerDelete): RedirectResponse
    {
        $em = $this->entityManager;
        $em->remove($customerDelete);
        $em->flush();
        return $this->redirectToRoute('list_customer');
    }

    #[Route('client/{id}/modifier', name: 'modify_customer')]
    public function modifyTask(Request $request, Customer $customerModify): Response
    {
        $form = $this->createForm(ModifyCustomerType::class, $customerModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerModify = $form->getData();
            $this->entityManager->persist($customerModify);
            $this->entityManager->flush();
            $this->addFlash('success', 'Client mis à jour !');
            return $this->redirectToRoute('modify_customer', ['id' => $customerModify->getId()]);
        }

        return $this->render('back/customer/modify.html.twig', [
            'form_customer_modify' => $form->createView(),
            'notification' => $notification,
            'customer' => $customerModify
        ]);
    }
}