<?php

namespace App\Controller;

use App\Entity\Branch;
use App\Entity\Employee;
use App\Entity\EmpData;
use App\Form\EmployeeType;
use App\Model\BranchModel;
use App\Model\DepartmentModel;
use App\Model\EmployeeModel;
use App\Model\EmploymentStatusModel;
use App\Model\EmpTelephoneModel;
use App\Model\EmpCustomModel;
use App\Model\EmpDataModel;
use App\Model\JobTitleModel;
use App\Model\PayGradeModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/report")
 */
class ReportController extends AbstractController
{

    //admin show all employees
    /**
     * @Route("/admin", name="employee_index", methods={"GET"})
     */
    public function index(): Response
    {
        $employeeModel = new EmployeeModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $employeeModel->getAllEmployees($entityManager);
        //custom attribute list
        $empCustomModel = new EmpCustomModel();
        $customAtrtibutes = $empCustomModel->getAllCustomAttributes($entityManager);

        //changing job title id and emp status id to job title and emp status
        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        $empTelephoneModel = new EmpTelephoneModel();
        $empDataModel = new EmpDataModel();
        foreach ($employees as &$employee){
            //job title
            $jobTitleId = $employee['job_title_id'];
            $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
            $employee['job_title'] = $jobTitle;
            //employment status
            $empStatusId = $employee['emp_status_id'];
            $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
            $employee["emp_status"] = $empStatus;
            //adding employee telephone no.s to employee array
            $empId = $employee['emp_id'];
            $empTelephone = $empTelephoneModel->getEmpTelephone($empId, $entityManager);
            $employee["emp_telephone"] = $empTelephone;
            //custom attributes
            $empCusAttr = $empDataModel->getDataByEmpId($empId, $entityManager);
            $employee["emp_cus_attr"] = $empCusAttr;
        }

        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
            'cus_attr' => $customAtrtibutes,
        ]);
    }

    //admin add new employee
    /**
     * @Route("/", name="report_index", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $branch = new Branch();
        $employee = new Employee();
        $reportModel = new ReportModel();
        $employeeModel = new EmployeeModel();
        $empDataModel = new EmpDataModel();
        $empCustomModel = new EmpCustomModel();
        $branchModel = new BranchModel();
        $deptModel = new DepartmentModel();
        $jobTitleModel = new JobTitleModel();
        $payGradeModel = new PayGradeModel();
        $employmentStatusModel = new EmploymentStatusModel();
        //Getting data from db for select drop down
        //branchId
        $branchIds = $branchModel->getAllBranches($entityManager);
        $branchChoices;
        foreach($branchIds as &$branch){
            $branchChoices[$branch['branch_id'].'-'.$branch['name']] = $branch['branch_id'];
        }
        //deptId
        $deptIds = $deptModel->getAllDepartments($entityManager);
        $deptChoices;
        foreach($deptIds as &$dept){
            $deptChoices[$dept['dept_id'].'-'.$dept['dept_name']] = $dept['dept_id'];
        }
        //jobTitle
        $jobTitles = $jobTitleModel->getAllJobTitles($entityManager);
        $jobTitleChoices;
        foreach($jobTitles as &$jobTitle){
            $jobTitleChoices[$jobTitle['job_title']] = $jobTitle['job_title'];
        }
        //payGrade
        $payGrades = $payGradeModel->getAllPayGrades($entityManager);
        $payGradeChoices;
        foreach($payGrades as &$payGrade){
            $payGradeChoices[$payGrade['pay_grade']] = $payGrade['pay_grade'];
        }
        //employment Status
        $empStatuses = $employmentStatusModel->getAllEmploymentStatuses($entityManager);
        $empStatusChoices;
        foreach($empStatuses as &$empStatus){
            $empStatusChoices[$empStatus['emp_status']] = $empStatus['emp_status'];
        }
        $formBranch = $this->createForm(ReportBranchType::class, $branch, array(
            'branch_choices' =>$branchChoices
        ));


        

        //adding fields for custom attributes
        // $cusAttr = $empCustomModel->getAllCustomAttributes($entityManager);
        // foreach($cusAttr as $customAttribute){
        //     $form->add($customAttribute['attribute'], TextType::class, array(
        //         "mapped" => false,
        //         "required" =>false,   
        //     ));
        // }        
        $formBranch->handleRequest($request);
        if ($formBranch->isSubmitted() && $formBranch->isValid()) {
            $employees = $reportModel->getEmpByBranch($entityManager,$branch);

            
            // //Getting job title id from job title for sql
            // $jobTitle = $employee->getJobTitle();
            // $jobTitleId = $jobTitleModel->getJobTitleId($jobTitle, $entityManager);
            // $employee->setJobTitleId(strval($jobTitleId));
            // //Getting employment status id from employment status           
            // $empStatus = $employee->getEmpStatus();
            // $empStatusId = $employmentStatusModel->getEmploymentStatusId($empStatus, $entityManager);
            // $employee->setEmpStatusId(strval($empStatusId));
            // //adding employee to db
            // $employeeModel->addEmployee($employee, $entityManager);
            // //adding custom attribute data to db
            // foreach($cusAttr as $customAttribute){
            //     $cusAttrData = $form->get($customAttribute['attribute'])->getData();
            //     $empData = new EmpData();
            //     $empData->setEmpId($employee->getEmpId());
            //     $empData->setAttribute($customAttribute['attribute']);
            //     $empData->setValue($cusAttrData);
            //     $empDataModel->addEmpData($empData, $entityManager);
            //}
            return $this->redirectToRoute('report_branch');
        }

        return $this->render('report/index.html.twig', [
            'form' => $formBranch->createView(),
        ]);
    }

    /**
     * @Route("/branch/{branch_id}", name="report_branch", methods={"GET"})
     */
    public function showEmpByBranch(): Response
    {
        $employeeModel = new EmployeeModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $employeeModel->getAllEmployees($entityManager);
        //custom attribute list
        $empCustomModel = new EmpCustomModel();
        $customAtrtibutes = $empCustomModel->getAllCustomAttributes($entityManager);

        //changing job title id and emp status id to job title and emp status
        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        $empTelephoneModel = new EmpTelephoneModel();
        $empDataModel = new EmpDataModel();
        foreach ($employees as &$employee){
            //job title
            $jobTitleId = $employee['job_title_id'];
            $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
            $employee['job_title'] = $jobTitle;
            //employment status
            $empStatusId = $employee['emp_status_id'];
            $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
            $employee["emp_status"] = $empStatus;
            //adding employee telephone no.s to employee array
            $empId = $employee['emp_id'];
            $empTelephone = $empTelephoneModel->getEmpTelephone($empId, $entityManager);
            $employee["emp_telephone"] = $empTelephone;
            //custom attributes
            $empCusAttr = $empDataModel->getDataByEmpId($empId, $entityManager);
            $employee["emp_cus_attr"] = $empCusAttr;
        }

        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
            'cus_attr' => $customAtrtibutes,
        ]);
    }
    
}
