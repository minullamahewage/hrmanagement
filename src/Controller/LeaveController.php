<?php

namespace App\Controller;

use App\Entity\Leave;
use App\Form\LeaveType;
use App\Model\LeaveModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leave")
 */
class LeaveController extends AbstractController
{
    /**
     * @Route("/", name="leave_index", methods={"GET"})
     */
    public function index(): Response
    {
        // $leaves = $this->getDoctrine()
        //     ->getRepository(Leave::class)
        //     ->findAll();
        $leaveModel = new LeaveModel();
        $entityManager = $this->getDoctrine()->getManager();
        $leaves = $leaveModel->getAllLeaves($entityManager);


        return $this->render('leave/index.html.twig', [
            'leaves' => $leaves,
        ]);
    }

    /**
     * @Route("/{empId}/new", name="leave_new", methods={"GET","POST"})
     */
    public function new(Request $request,$empId): Response
    {
        $leave = new Leave();
        $form = $this->createForm(LeaveType::class, $leave);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $leaveModel = new LeaveModel();
            $leave->setEmpId($empId);
            $leaveModel->addLeave($leave, $entityManager);
            return $this->redirectToRoute('leave_index');
        }

        return $this->render('leave/new.html.twig', [
            'leave' => $leave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{leaveFormId}", name="leave_show", methods={"GET"})
     */
    public function show(Leave $leave): Response
    {
        return $this->render('leave/show.html.twig', [
            'leave' => $leave,
        ]);
    }

    /**
     * @Route("/{leaveFormId}/edit", name="leave_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Leave $leave): Response
    {
        $form = $this->createForm(LeaveType::class, $leave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leave_index');
        }

        return $this->render('leave/edit.html.twig', [
            'leave' => $leave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{leaveFormId}", name="leave_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Leave $leave): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leave->getLeaveFormId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $leaveModel = new LeaveModel();
            $leaveModel->deleteLeave($leave, $entityManager);
        }

        return $this->redirectToRoute('leave_index');
    }
}
