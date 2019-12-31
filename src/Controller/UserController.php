<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//admin
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    //show all users
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userModel = new UserModel();
        $users= $userModel->getAllUsers($entityManager);

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }


    //show user details
    /**
     * @Route("/{userId}", name="user_show", methods={"GET"})
     */
    public function show($userId): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userModel = new UserModel();
        $user = $userModel->getUser($userId,$entityManager);
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    //delete user
    /**
     * @Route("/{userId}}", name="user_delete", methods={"DELETE"})
     */
    public function delete($userId): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userId, $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $userModel = new UserModel();
            $userModel->deleteUser($userId, $entityManager);
        }

        return $this->redirectToRoute('branch_index');
    }
}
