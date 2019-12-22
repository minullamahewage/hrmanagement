<?php

namespace App\Controller;

use App\Entity\EmpData;
use App\Form\EmpDataType;
use App\Model\EmpDataModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/empdata")
 */
class EmpDataController extends AbstractController
{
    /**
     * @Route("/", name="emp_data_index", methods={"GET"})
     */
    public function index(): Response
    {
        //$empDatas = $this->getDoctrine()
         //   ->getRepository(EmpData::class)
           // ->findAll();
           $entityManager = $this->getDoctrine()->getManager();
           $empDataModel = new EmpDataModel();
           $empDatas= $empDataModel->getAllEmpData($entityManager);
        return $this->render('emp_data/index.html.twig', [
            'emp_datas' => $empDatas,
        ]);
    }

    /**
     * @Route("/new", name="emp_data_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $empDatum = new EmpData();
        //$empData = new EmpData();
        $form = $this->createForm(EmpDataType::class, $empDatum);
       // $form = $this->createForm(EmpDataType::class, $empData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($empDatum);
            //$entityManager->flush();
            $empDataModel = new EmpDataModel();
            $empDataModel->addEmpData($empDatum, $entityManager);
            return $this->redirectToRoute('emp_data_index');
        }

        return $this->render('emp_data/new.html.twig', [
            'emp_datum' => $empDatum,
            //'emp_data' => $empData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{attribute}", name="emp_data_show", methods={"GET"})
     */
    public function show(EmpData $empDatum): Response
    {
        return $this->render('emp_data/show.html.twig', [
            'emp_datum' => $empDatum,
        ]);
    }

    /**
     * @Route("/{attribute}/edit", name="emp_data_edit", methods={"GET","POST"})
     */

    public function edit(Request $request, EmpData $empDatum): Response
    //public function edit(Request $request, EmpData $empData): Response
    {
        $empDataModel = new EmpDataModel();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(EmpDataType::class, $empDatum);
        //$form = $this->createForm(EmpDataType::class, $empData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$this->getDoctrine()->getManager()->flush();
            $empDataModel->changeEmpData($empDatum,$entityManager);
            return $this->redirectToRoute('emp_data_index');
        }

        return $this->render('emp_data/edit.html.twig', [
            'emp_datum' => $empDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{attribute}", name="emp_data_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmpData $empDatum): Response
    //public function delete(Request $request, EmpData $empData): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empDatum->getAttribute(), $request->request->get('_token'))) {
        //if ($this->isCsrfTokenValid('delete'.$empData->getAttribute(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $empDataModel = new EmpDataModel();
            $empDataModel->deleteEmpData($empDatum, $entityManager);
            //$entityManager->remove($empDatum);
            //$entityManager->flush();
        }

        return $this->redirectToRoute('emp_data_index');
    }
}
