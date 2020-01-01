<?php

namespace App\Controller;

use App\Entity\Leave;
use App\Form\LeaveType;
use App\Model\EmployeeModel;
use App\Model\LeaveModel;
use App\Model\LeaveTypeModel;
use App\Model\LeaveLimitModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leave")
 */
class LeaveController extends AbstractController
{
    //admin show all leave forms
    /**
     * @Route("/admin", name="leave_index", methods={"GET"})
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

    //employee request leave
    /**
     * @Route("/{empId}/new", name="leave_new", methods={"GET","POST"})
     */
    public function new(Request $request,$empId): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $empId = $user->getEmpId();
        $entityManager = $this->getDoctrine()->getManager();
        $leaveModel = new LeaveModel();
        $leaveTypeModel = new LeaveTypeModel();
        $leaveLimitModel = new LeaveLimitModel();
        $employeeModel = new EmployeeModel();
        $leave = new Leave();
        $payGrade = ($employeeModel->getEmpPayGrade($empId, $entityManager))[0]['pay_grade'];
        //getting data from db for leave type select drop down
        $leaveTypes = $leaveLimitModel->getPayGradeLeaveTypes($payGrade, $entityManager);
        foreach($leaveTypes as &$leaveType){
            $leaveTypeChoices[$leaveType['leave_type']] = $leaveType['leave_type'];
        }
        $form = $this->createForm(LeaveType::class, $leave, array(
            'leaveType_choices' =>$leaveTypeChoices,
        ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $remainingLeaves = $leaveModel->checkRemLeaves($empId, $leave->getLeaveType(), $entityManager);
            $days = ($leave->getTillDate()->diff($leave->getFromDate()))->format('%a');
            // var_dump($remainingLeaves); exit;
            // var_dump($remainingLeaves - $days);
            if ($remainingLeaves - $days>0){
                $leave->setEmpId($empId);
                $leaveModel->addLeave($leave, $entityManager);
                return $this->redirectToRoute('leave_emp',array('empId'=> $empId));
            }
            else{
                // var_dump("failed"); exit;
                return new Response('No leaves remaining from this type');
            }  
        }
        return $this->render('leave/new.html.twig', [
            'leave' => $leave,
            'form' => $form->createView(),
            'emp_id' =>$empId,
        ]);
    }

    //admin show leave form 
    /**
     * @Route("/admin/{leaveFormId}", name="leave_show", methods={"GET"})
     */
    public function show(Leave $leave): Response
    {
        return $this->render('leave/show.html.twig', [
            'leave' => $leave,
        ]);
    }

    //admin delete leave form
    /**
     * @Route("/admin/{leaveFormId}", name="leave_delete", methods={"DELETE"})
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
    //admin show leaves
    /**
     * @Route("/admin/show/{empId}", name="leave_emp_admin", methods={"GET"})
     */
    public function adminShowLeaves($empId): Response
    {
    
        $leaveModel = new LeaveModel();
        $entityManager = $this->getDoctrine()->getManager();
        $leaves = $leaveModel->getEmpLeaves($empId,$entityManager);
        $leavesRemaining  = $leaveModel->getEmpRemLeaves($empId,$entityManager);

        return $this->render('leave/emp.html.twig', [
            'leaves' => $leaves,
            'leaves_remaining' =>$leavesRemaining,
            'emp_id' =>$empId,
        ]);
    }

    //employee show leaves
    /**
     * @Route("/emp/{empId}", name="leave_emp", methods={"GET"})
     */
    public function empLeaves($empId): Response
    {
    
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $empId = $user->getEmpId();

        $leaveModel = new LeaveModel();
        $entityManager = $this->getDoctrine()->getManager();
        $leaves = $leaveModel->getEmpLeaves($empId,$entityManager);
        $leavesRemaining  = $leaveModel->getEmpRemLeaves($empId,$entityManager);

        return $this->render('leave/emp.html.twig', [
            'leaves' => $leaves,
            'leaves_remaining' =>$leavesRemaining,
            'emp_id' =>$empId,
        ]);
    }

    //supervisor view leave requests
    /**
     * @Route("/supervisor/requests/", name="leave_requests", methods={"GET"})
     */
    public function leaveRequests(): Response
    {
    
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $empId = $user->getEmpId();
        $leaveModel = new LeaveModel();
        $entityManager = $this->getDoctrine()->getManager();
        $leaves = $leaveModel->getLeaveRequests($empId,$entityManager);

        return $this->render('leave/sup.html.twig', [
            'leaves' => $leaves,
            'emp_id' =>$empId,
        ]);
    }

    //supervisor approve leave 
    /**
     * @Route("/supervisor/approve/{leaveFormId}-{empId}", name="leave_approve", methods={"APPROVE"})
     */
    public function approve(Request $request, Leave $leave, $leaveFormId, $empId): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $supId = $user->getEmpId();
        if ($this->isCsrfTokenValid('approve'.$leave->getLeaveFormId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $leaveModel = new LeaveModel();
            $remainingLeaves = $leaveModel->checkRemLeaves($empId, $leave->getLeaveType(), $entityManager);
            $days = ($leave->getTillDate()->diff($leave->getFromDate()))->format('%a');
            //var_dump($supId); exit;
            if ($remainingLeaves - $days>0){
                $leave->setEmpId($empId);
                $leaveModel->approveLeave($leaveFormId, $entityManager);
                return $this->redirectToRoute('leave_requests',array('empId'=> $supId));
            }
            else{
                // var_dump("failed"); exit;
                return new Response('No leaves remaining from this type');
            }  
        }
    }

    //supervisor deny leave 
    /**
     * @Route("/supervisor/deny/{leaveFormId}", name="leave_deny", methods={"DENY"})
     */
    public function deny(Request $request, Leave $leave, $leaveFormId): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $supId = $user->getEmpId();
        if ($this->isCsrfTokenValid('deny'.$leave->getLeaveFormId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $leaveModel = new LeaveModel();
            $leaveModel->denyLeave($leaveFormId, $entityManager);
        }

        return $this->redirectToRoute('leave_requests', array('empId' => $supId));
    }
}
