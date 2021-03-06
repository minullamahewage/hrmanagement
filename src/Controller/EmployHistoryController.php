<?php

namespace App\Controller;

use App\Entity\EmployHistory;
use App\Form\EmployHistoryType;
use App\Model\EmployHistoryModel;
use App\Model\EmploymentStatusModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employhistory")
 */
class EmployHistoryController extends AbstractController
{
    //admin view employment history
    /**
     * @Route("/", name="employ_history_index", methods={"GET"})
     */
    public function index(): Response
    {
        // $employHistories = $this->getDoctrine()
        //     ->getRepository(EmployHistory::class)
        //     ->findAll();
        $employHistoryModel = new EmployHistoryModel();
        $employStatusModel = new EmploymentStatusModel;
        $entityManager = $this->getDoctrine()->getManager();
        $employHistories = $employHistoryModel->getAllEmployHistories($entityManager);

       

        foreach ($employHistories as &$employHistory){
            $empStatusId = $employHistory['emp_status_id'];
            $empStatus = $employStatusModel->getEmploymentStatus($empStatusId, $entityManager);
            $employHistory["emp_status"] = $empStatus;
        }

        return $this->render('employ_history/index.html.twig', [
            'employ_histories' => $employHistories,
        ]);
    }

    //admin add new employment history entry
    /**
     * @Route("/new", name="employ_history_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employHistory = new EmployHistory();
        $employmentStatusModel = new EmploymentStatusModel();
        $employHistoryModel = new EmployHistoryModel();
        $entityManager = $this->getDoctrine()->getManager();
         // //employment Status
         $empStatuses = $employmentStatusModel->getAllEmploymentStatuses($entityManager);
         $empStatusChoices;
         foreach($empStatuses as &$empStatus){
             $empStatusChoices[$empStatus['id'].'-'.$empStatus['emp_status']] = $empStatus['id'];
         }
         $form = $this->createForm(EmployHistoryType::class,$employHistory, array(
            'emp_status_choices' =>$empStatusChoices,
        )); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$employHistory->get
            //Getting employment status id from id
            // $employmentStatusModel = new EmploymentStatusModel();
            // $empStatusId = $employmentStatusModel->getEmploymentStatusId($empStatus, $entityManager);
            // $employHistory->setEmpStatusId(strval($empStatusId));
            // var_dump($employHistory); exit;
            $employHistoryModel->addEmployHistory($employHistory, $entityManager);

            return $this->redirectToRoute('employ_history_index');
        }

        return $this->render('employ_history/new.html.twig', [
            'employ_history' => $employHistory,
            'form' => $form->createView(),
        ]);
    }

    //admin show employment history entry details
    /**
     * @Route("/{empHistoryId}", name="employ_history_show", methods={"GET"})
     */
    public function show(EmployHistory $employHistory): Response
    {
        return $this->render('employ_history/show.html.twig', [
            'employ_history' => $employHistory,
        ]);
    }

    //admin edit employment history details
    /**
     * @Route("/{empHistoryId}/edit", name="employ_history_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmployHistory $employHistory): Response
    {
        $employmentStatusModel = new EmploymentStatusModel();
        $employHistoryModel = new EmployHistoryModel();
        $entityManager = $this->getDoctrine()->getManager();
         // //employment Status
         $empStatuses = $employmentStatusModel->getAllEmploymentStatuses($entityManager);
         $empStatusChoices;
         foreach($empStatuses as &$empStatus){
             $empStatusChoices[$empStatus['id'].'-'.$empStatus['emp_status']] = $empStatus['id'];
         }
         $form = $this->createForm(EmployHistoryType::class,$employHistory, array(
            'emp_status_choices' =>$empStatusChoices,
        )); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employ_history_index');
        }

        return $this->render('employ_history/edit.html.twig', [
            'employ_history' => $employHistory,
            'form' => $form->createView(),
        ]);
    }

    //admin delete employment history
    /**
     * @Route("/{empHistoryId}", name="employ_history_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmployHistory $employHistory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employHistory->getEmpHistoryId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->remove($employHistory);
            // $entityManager->flush();
            $employHistoryModel= new EmployHistoryModel();
            $employHistoryModel->deleteEmployHistory($employHistory, $entityManager);
        }

        return $this->redirectToRoute('employ_history_index');
    }

    //employee view personal employment history
    /**
     * @Route("/emp/{empId}", name="employhistory_emp", methods={"GET"})
     */
    public function empEmployHistory($empId): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $empId = $user->getEmpId();
        $employHistoryModel = new EmployHistoryModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employHistories = $employHistoryModel->getEmployHistory($empId,$entityManager);
        $employStatusModel = new EmploymentStatusModel;

        foreach ($employHistories as &$employHistory){
            $empStatusId = $employHistory['emp_status_id'];
            $empStatus = $employStatusModel->getEmploymentStatus($empStatusId, $entityManager);
            $employHistory["emp_status"] = $empStatus;
        }
        return $this->render('employ_history/emp.html.twig', [
            'employ_histories' => $employHistories,
            'emp_id' => $empId,
        ]);
    }
}
