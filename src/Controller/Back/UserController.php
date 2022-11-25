<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\Back\User\AddUserType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\User\ModifyUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
    * @Route("/admin/utilisateurs", name="user_list")
    */
    public function index(UserRepository $userAdmin): Response
    {
        return $this->render('back/user/list.html.twig', [
            'user' => $userAdmin->findBy(array(), array('firstname' => 'ASC')),
        ]);
    }

    /**
    * @Route("/admin/utilisateurs/ajouter", name="user_add")
    */
    public function addUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(AddUserType:: class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();
                $password = $encoder->encodePassword($user,$user->getPassword());
                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $user = new User();
                $form = $this->createForm(AddUserType:: class, $user);
                return $this->redirectToRoute("user_list");
            }
        return $this->render('back/user/add.html.twig', [
            'form_user_add' => $form->createView(),

        ]);
    }

    /**
     * @Route("/admin/utilisateurs/{id}/modifier", name="user_modify")
     */
    public function modifyUser(User $userTitle, Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(ModifyUserType::class, $user);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $notification = 'Utilisateur mis à jour !';
            $user = new User();
            $user = $form->getData();
            $form = $this->createForm(ModifyUserType::class, $user);
        }

        return $this->render('back/user/modify.html.twig', [
            'form_user_modify' => $form->createView(),
            'notification' => $notification,
            'user' => $userTitle
        ]);
    }   

    /**
    * @Route("/admin/utilisateurs/{id}/supprimer", name="user_delete")
    * @param User $user
    * return RedirectResponse
    */
    public function deleteUser(User $user): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("user_list");
    }
    
}
