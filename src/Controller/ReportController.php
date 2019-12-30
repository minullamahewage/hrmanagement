<?php
namespace App\Controller;

use App\Entity\Branch;
use App\Entity\Employee;
use App\Entity\EmpData;
use App\Form\ReportsForm\ReportBranchType;
use App\Form\ReportsForm\ReportDeptType;
use App\Model\BranchModel;
use App\Model\DepartmentModel;
use App\Model\EmployeeModel;
use App\Model\EmploymentStatusModel;
use App\Model\EmpTelephoneModel;
use App\Model\EmpCustomModel;
use App\Model\EmpDataModel;
use App\Model\JobTitleModel;
use App\Model\PayGradeModel;
use App\Model\ReportModel;
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

    // //admin show all employees
    // /**
    //  * @Route("/admin", name="employee_index", methods={"GET"})
    //  */
    // public function test(): Response
    // {
    //     $employeeModel = new EmployeeModel();
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $employees = $employeeModel->getAllEmployees($entityManager);
    //     //custom attribute list
    //     $empCustomModel = new EmpCustomModel();
    //     $customAtrtibutes = $empCustomModel->getAllCustomAttributes($entityManager);

    //     //changing job title id and emp status id to job title and emp status
    //     $jobTitleModel = new JobTitleModel();
    //     $empStatusModel = new EmploymentStatusModel();
    //     $empTelephoneModel = new EmpTelephoneModel();
    //     $empDataModel = new EmpDataModel();
    //     foreach ($employees as &$employee){
    //         //job title
    //         $jobTitleId = $employee['job_title_id'];
    //         $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
    //         $employee['job_title'] = $jobTitle;
    //         //employment status
    //         $empStatusId = $employee['emp_status_id'];
    //         $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
    //         $employee["emp_status"] = $empStatus;
    //         //adding employee telephone no.s to employee array
    //         $empId = $employee['emp_id'];
    //         $empTelephone = $empTelephoneModel->getEmpTelephone($empId, $entityManager);
    //         $employee["emp_telephone"] = $empTelephone;
    //         //custom attributes
    //         $empCusAttr = $empDataModel->getDataByEmpId($empId, $entityManager);
    //         $employee["emp_cus_attr"] = $empCusAttr;
    //     }

    //     return $this->render('employee/index.html.twig', [
    //         'employees' => $employees,
    //         'cus_attr' => $customAtrtibutes,
    //     ]);
    // }


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
        foreach($branchIds as &$branch1){
            $branchChoices[$branch1['branch_id'].'-'.$branch1['name']] = $branch1['branch_id'];
        }
        // //deptId
         $deptIds = $deptModel->getAllDepartments($entityManager);
         $deptChoices;
         foreach($deptIds as &$dept1){
             $deptChoices[$dept1['dept_id'].'-'.$dept1['dept_name']] = $dept1['dept_id'];
         }
        // //jobTitle
        // $jobTitles = $jobTitleModel->getAllJobTitles($entityManager);
        // $jobTitleChoices;
        // foreach($jobTitles as &$jobTitle){
        //     $jobTitleChoices[$jobTitle['job_title']] = $jobTitle['job_title'];
        // }
        // //payGrade
        // $payGrades = $payGradeModel->getAllPayGrades($entityManager);
        // $payGradeChoices;
        // foreach($payGrades as &$payGrade){
        //     $payGradeChoices[$payGrade['pay_grade']] = $payGrade['pay_grade'];
        // }
        // //employment Status
        // $empStatuses = $employmentStatusModel->getAllEmploymentStatuses($entityManager);
        // $empStatusChoices;
        // foreach($empStatuses as &$empStatus){
        //     $empStatusChoices[$empStatus['emp_status']] = $empStatus['emp_status'];
        // }
        $formBranch = $this->createForm(ReportBranchType::class, $branch, array(
            'branch_choices' =>$branchChoices,
        ));     
        $formBranch->handleRequest($request);
        if ($formBranch->isSubmitted() && $formBranch->isValid()) {
            $branchId = $branch->getBranchId();
            return $this->redirectToRoute('report_branch', array('branchId' =>$branchId));
        }

        return $this->render('report/index.html.twig', [
            'form_branch' => $formBranch->createView(),
        ]);

        
        $formDept = $this->createForm(ReportDeptType::class, $dept, array(
            'dept_choices' =>$deptChoices,
        ));     
        $formDept->handleRequest($request);
        if ($formDept->isSubmitted() && $formDept->isValid()) {
            $deptId = $dept->getDeptId();
            return $this->redirectToRoute('report_dept', array('deptId' =>$deptId));
        }

        return $this->render('report/index.html.twig', [
            'form_dept' => $formDept->createView(),
        ]);
    }

    /**
     * @Route("/branch/{branchId}", name="report_branch", methods={"GET"})
     */
    public function showEmpByBranch($branchId): Response
    {
        $employeeModel = new EmployeeModel();
        $branchModel = new BranchModel();
        $reportModel = new ReportModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $reportModel->getEmpByBranch($branchId, $entityManager);
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
        }


        return $this->render('report/branch.html.twig', [
            'employees' => $employees,
        ]);
    }
    
    /**
     * @Route("/dept/{deptId}", name="report_dept", methods={"GET"})
     */
    public function showEmpByDept($deptId): Response
    {
        $employeeModel = new EmployeeModel();
        $branchModel = new BranchModel();
        $reportModel = new ReportModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $reportModel->getEmpByDept($deptId, $entityManager);
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
        }


        return $this->render('report/dept.html.twig', [
            'employees' => $employees,
        ]);
    }
}
