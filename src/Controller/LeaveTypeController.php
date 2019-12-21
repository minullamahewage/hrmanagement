<?php

namespace App\Controller;

use App\Entity\LeaveType;
use App\Form\LeaveTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leavetype")
 */
class LeaveTypeController extends AbstractController
{
    /**
     * @Route("/", name="leave_type_index", methods={"GET"})
     */
    public function index(): Response
    {
        $leaveTypes = $this->getDoctrine()
            ->getRepository(LeaveType::class)
            ->findAll();

        return $this->render('leave_type/index.html.twig', [
            'leave_types' => $leaveTypes,
        ]);
    }

    /**
     * @Route("/new", name="leave_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $leaveType = new LeaveType();
        $form = $this->createForm(LeaveTypeType::class, $leaveType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($leaveType);
            $entityManager->flush();

            return $this->redirectToRoute('leave_type_index');
        }

        return $this->render('leave_type/new.html.twig', [
            'leave_type' => $leaveType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{leaveType}", name="leave_type_show", methods={"GET"})
     */
    public function show(LeaveType $leaveType): Response
    {
        return $this->render('leave_type/show.html.twig', [
            'leave_type' => $leaveType,
        ]);
    }

    /**
     * @Route("/{leaveType}/edit", name="leave_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LeaveType $leaveType): Response
    {
        $form = $this->createForm(LeaveTypeType::class, $leaveType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leave_type_index');
        }

        return $this->render('leave_type/edit.html.twig', [
            'leave_type' => $leaveType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{leaveType}", name="leave_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LeaveType $leaveType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leaveType->getLeaveType(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($leaveType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('leave_type_index');
    }
}
