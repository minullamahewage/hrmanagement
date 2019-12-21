<?php

namespace App\Controller;

use App\Entity\EmploymentStatus;
use App\Form\EmploymentStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employment/status")
 */
class EmploymentStatusController extends AbstractController
{
    /**
     * @Route("/", name="employment_status_index", methods={"GET"})
     */
    public function index(): Response
    {
        $employmentStatuses = $this->getDoctrine()
            ->getRepository(EmploymentStatus::class)
            ->findAll();

        return $this->render('employment_status/index.html.twig', [
            'employment_statuses' => $employmentStatuses,
        ]);
    }

    /**
     * @Route("/new", name="employment_status_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employmentStatus = new EmploymentStatus();
        $form = $this->createForm(EmploymentStatusType::class, $employmentStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employmentStatus);
            $entityManager->flush();

            return $this->redirectToRoute('employment_status_index');
        }

        return $this->render('employment_status/new.html.twig', [
            'employment_status' => $employmentStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employment_status_show", methods={"GET"})
     */
    public function show(EmploymentStatus $employmentStatus): Response
    {
        return $this->render('employment_status/show.html.twig', [
            'employment_status' => $employmentStatus,
        ]);
    }

    // /**
    //  * @Route("/{id}/edit", name="employment_status_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, EmploymentStatus $employmentStatus): Response
    // {
    //     $form = $this->createForm(EmploymentStatusType::class, $employmentStatus);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('employment_status_index');
    //     }

    //     return $this->render('employment_status/edit.html.twig', [
    //         'employment_status' => $employmentStatus,
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
     * @Route("/{id}", name="employment_status_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmploymentStatus $employmentStatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employmentStatus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employmentStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employment_status_index');
    }
}
