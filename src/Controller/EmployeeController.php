<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Model\EmployeeModel;
use App\Model\JobTitleModel;
use App\Model\EmploymentStatusModel;
use App\Model\EmpTelephoneModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employee")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route("/", name="employee_index", methods={"GET"})
     */
    public function index(): Response
    {
        // $employees = $this->getDoctrine()
        //     ->getRepository(Employee::class)
        //     ->findAll();
        $employeeModel = new EmployeeModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $employeeModel->getAllEmployees($entityManager);

        //changing job title id and emp status id to job title and emp status
        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        $empTelephoneModel = new EmpTelephoneModel();
        foreach ($employees as &$employee){
            $jobTitleId = $employee['job_title_id'];
            $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
            $employee['job_title'] = $jobTitle;

            $empStatusId = $employee['emp_status_id'];
            $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
            $employee["emp_status"] = $empStatus;

            $empId = $employee['emp_id'];
            $empTelephone = $empTelephoneModel->getEmpTelephone($empId, $entityManager);
            $employee["emp_telephone"] = $empTelephone;
        }

        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * @Route("/new", name="employee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $employeeModel = new EmployeeModel();
            //Getting job title id from job title id for sql
            $jobTitleModel = new JobTitleModel();
            $jobTitle = $employee->getJobTitle();
            $jobTitleId = $jobTitleModel->getJobTitleId($jobTitle, $entityManager);
            $employee->setJobTitleId(strval($jobTitleId));
            //Getting employment status id from id
            $employmentStatusModel = new EmploymentStatusModel();
            $empStatus = $employee->getEmpStatus();
            $empStatusId = $employmentStatusModel->getEmploymentStatusId($empStatus, $entityManager);
            $employee->setEmpStatusId(strval($empStatusId));
            //adding employee to db
            $employeeModel->addEmployee($employee, $entityManager);

            return $this->redirectToRoute('employee_index');
        }

        return $this->render('employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{empId}", name="employee_show", methods={"GET"})
     */
    public function show(Employee $employee): Response
    {
        //changing job title id and emp status id to job title and emp status
        $entityManager = $this->getDoctrine()->getManager();
        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        $empTelephoneModel = new EmpTelephoneModel();
        //job title
        $jobTitleId = $employee->getJobTitleId();
        $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
        $employee->setJobTitle($jobTitle);
        //emply status
        $empStatusId = $employee->getEmpStatusId();
        $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
        $employee->setEmpStatus($empStatus);
        //emp telephone
        $empId = $employee->getEmpId();
        $empTelephone = $empTelephoneModel->getEmpTelephone($empId, $entityManager);
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
            'emp_telephone' => $empTelephone,
        ]);
    }

    /**
     * @Route("/{empId}/edit", name="employee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employee $employee): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $employeeModel = new EmployeeModel();
            $employeeModel->changeEmployee($employee, $entityManager);

            return $this->redirectToRoute('employee_index');
        }

        return $this->render('employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{empId}", name="employee_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Employee $employee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getEmpId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $employeeModel = new EmployeeModel();
            $employeeModel->deleteEmployee($employee, $entityManager);
        }

        return $this->redirectToRoute('employee_index');
    }

    /**
     * @Route("/subordinate/{empId}", name="employee_subordinate", methods={"GET"})
     */
    public function showSubordinates($empId): Response
    {
        //changing job title id and emp status id to job title and emp status
        $entityManager = $this->getDoctrine()->getManager();
        $employeeModel = new EmployeeModel();
        $subordinates = $employeeModel->getSubordinates($empId, $entityManager);

        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        foreach ($subordinates as &$subordinate){
            $jobTitleId = $subordinate['job_title_id'];
            $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
            $subordinate['job_title'] = $jobTitle;
            

            $empStatusId = $subordinate['emp_status_id'];
            $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
            $subordinate["emp_status"] = $empStatus;
        }
        return $this->render('employee/subordinate.html.twig', [
            'subordinates' => $subordinates,
        ]);
    }
}
