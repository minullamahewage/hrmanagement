<?php

namespace App\Controller;

use App\Entity\EmpData;
use App\Form\EmpDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emp/data")
 */
class EmpDataController extends AbstractController
{
    /**
     * @Route("/", name="emp_data_index", methods={"GET"})
     */
    public function index(): Response
    {
        $empDatas = $this->getDoctrine()
            ->getRepository(EmpData::class)
            ->findAll();

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
        $form = $this->createForm(EmpDataType::class, $empDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empDatum);
            $entityManager->flush();

            return $this->redirectToRoute('emp_data_index');
        }

        return $this->render('emp_data/new.html.twig', [
            'emp_datum' => $empDatum,
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
     * @Route("/{emp_id}{attribute}/edit", name="emp_data_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmpData $empDatum): Response
    {
        $form = $this->createForm(EmpDataType::class, $empDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

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
    {
        if ($this->isCsrfTokenValid('delete'.$empDatum->getAttribute(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($empDatum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('emp_data_index');
    }
}
