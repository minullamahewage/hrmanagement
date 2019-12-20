<?php

namespace App\Controller;

use App\Entity\Dependent;
use App\Form\DependentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dependent")
 */
class DependentController extends AbstractController
{
    /**
     * @Route("/", name="dependent_index", methods={"GET"})
     */
    public function index(): Response
    {
        $dependents = $this->getDoctrine()
            ->getRepository(Dependent::class)
            ->findAll();

        return $this->render('dependent/index.html.twig', [
            'dependents' => $dependents,
        ]);
    }

    /**
     * @Route("/new", name="dependent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dependent = new Dependent();
        $form = $this->createForm(DependentType::class, $dependent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dependent);
            $entityManager->flush();

            return $this->redirectToRoute('dependent_index');
        }

        return $this->render('dependent/new.html.twig', [
            'dependent' => $dependent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{dependentId}", name="dependent_show", methods={"GET"})
     */
    public function show(Dependent $dependent): Response
    {
        return $this->render('dependent/show.html.twig', [
            'dependent' => $dependent,
        ]);
    }

    /**
     * @Route("/{dependentId}/edit", name="dependent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dependent $dependent): Response
    {
        $form = $this->createForm(DependentType::class, $dependent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dependent_index');
        }

        return $this->render('dependent/edit.html.twig', [
            'dependent' => $dependent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{dependentId}", name="dependent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dependent $dependent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dependent->getDependentId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dependent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dependent_index');
    }
}
