<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Model\DepartmentModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/department")
 */
class DepartmentController extends AbstractController
{
    //admin show all departments
    /**
     * @Route("/", name="department_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $departmentModel=new DepartmentModel();
        //$departments = $this->getDoctrine()
        //    ->getRepository(Department::class)
        //    ->findAll();
        $departments=$departmentModel->getAllDepartments($entityManager);
        return $this->render('department/index.html.twig', [
            'departments' => $departments,
        ]);
    }

    //admin add new department
    /**
     * @Route("/new", name="department_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $department = new Department();
        $departmentModel = new DepartmentModel();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($department);
            //$entityManager->flush();
            $departmentModel->addDepartment($department, $entityManager);
            return $this->redirectToRoute('department_index');
        }

        return $this->render('department/new.html.twig', [
            'department' => $department,
            'form' => $form->createView(),
        ]);
    }

    //admin show department details
    /**
     * @Route("/{deptId}", name="department_show", methods={"GET"})
     */
    public function show(Department $department): Response
    {
        return $this->render('department/show.html.twig', [
            'department' => $department,
        ]);
    }

    //admin edit department
    /**
     * @Route("/{deptId}/edit", name="department_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Department $department): Response
    {
        $departmentModel = new DepartmentModel();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$this->getDoctrine()->getManager()->flush();
            $departmentModel->changeDepartmentDetails($department,$entityManager);
            return $this->redirectToRoute('department_index');
        }

        return $this->render('department/edit.html.twig', [
            'department' => $department,
            'form' => $form->createView(),
        ]);
    }

    //admin delete department
    /**
     * @Route("/{deptId}", name="department_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Department $department): Response
    {
        if ($this->isCsrfTokenValid('delete'.$department->getDeptId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->remove($department);
            //$entityManager->flush();
            $departmentModel = new DepartmentModel();
            $departmentModel->deleteDepartment($department->getDeptId(), $entityManager);
        }
        return $this->redirectToRoute('department_index');
    }
}
