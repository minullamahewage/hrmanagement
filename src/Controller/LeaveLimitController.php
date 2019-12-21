<?php

namespace App\Controller;

use App\Entity\LeaveLimit;
use App\Form\LeaveLimitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leavelimit")
 */
class LeaveLimitController extends AbstractController
{
    /**
     * @Route("/", name="leave_limit_index", methods={"GET"})
     */
    public function index(): Response
    {
        $leaveLimits = $this->getDoctrine()
            ->getRepository(LeaveLimit::class)
            ->findAll();

        return $this->render('leave_limit/index.html.twig', [
            'leave_limits' => $leaveLimits,
        ]);
    }

    /**
     * @Route("/new", name="leave_limit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $leaveLimit = new LeaveLimit();
        $form = $this->createForm(LeaveLimitType::class, $leaveLimit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($leaveLimit);
            $entityManager->flush();

            return $this->redirectToRoute('leave_limit_index');
        }

        return $this->render('leave_limit/new.html.twig', [
            'leave_limit' => $leaveLimit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{payGrade}-{leaveType}", name="leave_limit_show", methods={"GET"})
     */
    public function show(LeaveLimit $leaveLimit): Response
    {
        return $this->render('leave_limit/show.html.twig', [
            'leave_limit' => $leaveLimit,
        ]);
    }

    /**
     * @Route("/{payGrade}/{leaveType}/edit", name="leave_limit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LeaveLimit $leaveLimit): Response
    {
        $form = $this->createForm(LeaveLimitType::class, $leaveLimit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leave_limit_index');
        }

        return $this->render('leave_limit/edit.html.twig', [
            'leave_limit' => $leaveLimit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{leaveType}", name="leave_limit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LeaveLimit $leaveLimit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leaveLimit->getLeaveType(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($leaveLimit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('leave_limit_index');
    }
}
