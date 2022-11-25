<?php

namespace App\Controller\Back;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Customer\AddCustomerType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Back\Customer\ModifyCustomerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
/**
* @Route("/admin/")
*/
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
    }
    /**
     * @Route("clients", name="list_customer")
     */
    public function listCustomers(CustomerRepository $customerAdmin): Response
    {
        //Count Customer
        $em = $this->getDoctrine()->getManager();
        $repoCustomer = $em->getRepository(Customer::class);
        $totalCustomer = $repoCustomer->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('back/customer/list.html.twig', [
            'customer' => $customerAdmin->findBy(array(), array('name' => 'ASC')),
            'totalCustomer' => $totalCustomer
        ]);
    }

    /**
     * @Route("client/ajouter", name="add_customer")
     */
    public function index(Request $request): Response {
        $customerAdd = new Customer();
        $form = $this->createForm(AddCustomerType::class, $customerAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($customerAdd);
            $this->entityManager->flush();
            $notification = 'Le client a bien été ajouté';
            $customerAdd = new Customer();
            $form = $this->createForm(AddCustomerType::class, $customerAdd);
        }
            return $this->render('back/customer/add.html.twig', [
                'form_customer_add' => $form->createView(),
                'notification' => $notification
            ]);
        }

    /**
     * @Route("client/{id}/supprimer", name="delete_customer")
     * @param Customer $customerDelete
     * return RedirectResponse
     */
    public function deleteStatut(Customer $customerDelete): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($customerDelete);
        $em->flush();
        return $this->redirectToRoute("list_customer");
    }

    /**
     * @Route("client/{id}/modifier", name="modify_customer")
     */
    public function modifyTask(Request $request, Customer $customerModify): Response
    {
        $form = $this->createForm(ModifyCustomerType::class, $customerModify);
        $notification = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $customerModify = $form->getData();
            $this->entityManager->persist($customerModify);
            $this->entityManager->flush();
            $notification = 'Client mise à jour !';
            $form = $this->createForm(ModifyCustomerType::class, $customerModify);
        }
        return $this->render('back/customer/modify.html.twig',[
            'form_customer_modify' => $form->createView(),
            'notification' =>$notification,
            'customer' => $customerModify
        ]);   
    }
    
}
