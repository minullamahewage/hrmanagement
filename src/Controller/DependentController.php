<?php

namespace App\Controller;

use App\Entity\Dependent;
use App\Form\DependentType;
use App\Model\DependentModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dependent")
 */
class DependentController extends AbstractController
{
    //admin view all dependents
    /**
     * @Route("/admin", name="dependent_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $dependentModel=new DependentModel();
        $dependents=$dependentModel->getAllDependents($entityManager);
        return $this->render('dependent/index.html.twig', [
            'dependents' => $dependents,
        ]);
    }

    //admin add new dependent
    /**
     * @Route("/admin/new", name="dependent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dependent = new Dependent();
        $dependentModel = new DependentModel();
        $form = $this->createForm(DependentType::class, $dependent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($dependent);
            //$entityManager->flush();
            $dependentModel->addDependent($dependent,$entityManager);
            return $this->redirectToRoute('dependent_index');
        }

        return $this->render('dependent/new.html.twig', [
            'dependent' => $dependent,
            'form' => $form->createView(),
        ]);
    }

    //admin show dependent details
    /**
     * @Route("/admin/{dependentId}", name="dependent_show", methods={"GET"})
     */
    public function show(Dependent $dependent): Response
    {
        return $this->render('dependent/show.html.twig', [
            'dependent' => $dependent,
        ]);
    }

    //admin edit dependent details
    /**
     * @Route("/admin/{dependentId}/edit", name="dependent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dependent $dependent): Response
    {
        $dependentModel = new DependentModel();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(DependentType::class, $dependent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$this->getDoctrine()->getManager()->flush();
            $dependentModel->changeDependentDetails($dependent,$entityManager);
            return $this->redirectToRoute('dependent_index');
        }

        return $this->render('dependent/edit.html.twig', [
            'dependent' => $dependent,
            'form' => $form->createView(),
        ]);
    }

    //admin delete dependent
    /**
     * @Route("/admin/{dependentId}", name="dependent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dependent $dependent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dependent->getDependentId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->remove($dependent);
            //$entityManager->flush();
            $dependentModel = new DependentModel();
            $dependentModel->deleteDependent($dependent, $entityManager);
        }

        return $this->redirectToRoute('dependent_index');
    }

    //employee show dependents
    /**
     * @Route("/emp/{empId}", name="dependent_emp", methods={"GET"})
     */
    public function empDependent($empId): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $dependentModel=new DependentModel();

        //$dependents = $this->getDoctrine()
          //  ->getRepository(Dependent::class)
            //->findAll();
        $dependents=$dependentModel->getEmpDependent($empId, $entityManager);
        return $this->render('dependent/emp.html.twig', [
            'dependents' => $dependents,
            'emp_id' => $empId,
        ]);
    }
}
