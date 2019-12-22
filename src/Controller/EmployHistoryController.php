<?php

namespace App\Controller;

use App\Entity\EmployHistory;
use App\Form\EmployHistoryType;
use App\Model\EmployHistoryModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employhistory")
 */
class EmployHistoryController extends AbstractController
{
    /**
     * @Route("/", name="employ_history_index", methods={"GET"})
     */
    public function index(): Response
    {
        // $employHistories = $this->getDoctrine()
        //     ->getRepository(EmployHistory::class)
        //     ->findAll();
        $employHistoryModel = new EmployHistoryModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employHistories = $employHistoryModel->getAllEmployHistories($entityManager);
        return $this->render('employ_history/index.html.twig', [
            'employ_histories' => $employHistories,
        ]);
    }

    /**
     * @Route("/new", name="employ_history_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employHistory = new EmployHistory();
        $employHistoryModel = new EmployHistoryModel();
        $form = $this->createForm(EmployHistoryType::class, $employHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($employHistory);
            // $entityManager->flush();
            $employHistoryModel->addEMployHistory($employHistory, $entityManager);

            return $this->redirectToRoute('employ_history_index');
        }

        return $this->render('employ_history/new.html.twig', [
            'employ_history' => $employHistory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{empHistoryId}", name="employ_history_show", methods={"GET"})
     */
    public function show(EmployHistory $employHistory): Response
    {
        return $this->render('employ_history/show.html.twig', [
            'employ_history' => $employHistory,
        ]);
    }

    /**
     * @Route("/{empHistoryId}/edit", name="employ_history_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmployHistory $employHistory): Response
    {
        $form = $this->createForm(EmployHistoryType::class, $employHistory);
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
}
