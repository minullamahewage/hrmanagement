<?php

namespace App\Controller;

use App\Entity\EmpCustom;
use App\Form\EmpCustomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emp/custom")
 */
class EmpCustomController extends AbstractController
{
    /**
     * @Route("/", name="emp_custom_index", methods={"GET"})
     */
    public function index(): Response
    {
        $empCustoms = $this->getDoctrine()
            ->getRepository(EmpCustom::class)
            ->findAll();

        return $this->render('emp_custom/index.html.twig', [
            'emp_customs' => $empCustoms,
        ]);
    }

    /**
     * @Route("/new", name="emp_custom_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $empCustom = new EmpCustom();
        $form = $this->createForm(EmpCustomType::class, $empCustom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empCustom);
            $entityManager->flush();

            return $this->redirectToRoute('emp_custom_index');
        }

        return $this->render('emp_custom/new.html.twig', [
            'emp_custom' => $empCustom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{attribute}", name="emp_custom_show", methods={"GET"})
     */
    public function show(EmpCustom $empCustom): Response
    {
        return $this->render('emp_custom/show.html.twig', [
            'emp_custom' => $empCustom,
        ]);
    }

    /**
     * @Route("/{attribute}/edit", name="emp_custom_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmpCustom $empCustom): Response
    {
        $form = $this->createForm(EmpCustomType::class, $empCustom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emp_custom_index');
        }

        return $this->render('emp_custom/edit.html.twig', [
            'emp_custom' => $empCustom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{attribute}", name="emp_custom_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmpCustom $empCustom): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empCustom->getAttribute(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($empCustom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('emp_custom_index');
    }
}
