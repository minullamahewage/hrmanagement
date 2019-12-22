<?php

namespace App\Controller;

use App\Entity\EmpTelephone;
use App\Form\EmpTelephoneType;
use App\Model\EmpTelephoneModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emptelephone")
 */
class EmpTelephoneController extends AbstractController
{
    /**
     * @Route("/", name="emp_telephone_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $empTelephoneModel = new EmpTelephoneModel();
        $empTelephones= $empTelephoneModel->getAllEmpTelephones($entityManager);
        //$empTelephones = $this->getDoctrine()
            //->getRepository(EmpTelephone::class)
            //->findAll();

        return $this->render('emp_telephone/index.html.twig', [
            'emp_telephones' => $empTelephones,
        ]);
    }

    /**
     * @Route("/new", name="emp_telephone_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $empTelephone = new EmpTelephone();
        $form = $this->createForm(EmpTelephoneType::class, $empTelephone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $empTelephoneModel = new EmpTelephoneModel();
            $empTelephoneModel->addEmpTelephone($empTelephone, $entityManager);
            //$entityManager->persist($empTelephone);
            //$entityManager->flush();

            return $this->redirectToRoute('emp_telephone_index');
        }

        return $this->render('emp_telephone/new.html.twig', [
            'emp_telephone' => $empTelephone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{telephone}", name="emp_telephone_show", methods={"GET"})
     */
    public function show(EmpTelephone $empTelephone): Response
    {
        return $this->render('emp_telephone/show.html.twig', [
            'emp_telephone' => $empTelephone,
        ]);
    }

    /**
     * @Route("/{telephone}/edit", name="emp_telephone_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmpTelephone $empTelephone): Response
    {
        $form = $this->createForm(EmpTelephoneType::class, $empTelephone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emp_telephone_index');
        }

        return $this->render('emp_telephone/edit.html.twig', [
            'emp_telephone' => $empTelephone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{telephone}", name="emp_telephone_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmpTelephone $empTelephone): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empTelephone->getTelephone(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->remove($empTelephone);
            //$entityManager->flush();
            $empTelephoneModel = new EmpTelephoneModel();
            $empTelephoneModel->deleteEmpTelephone($empTelephone, $entityManager);

        }

        return $this->redirectToRoute('emp_telephone_index');
    }
}
