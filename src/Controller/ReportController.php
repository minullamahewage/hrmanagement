<?php
namespace App\Controller;

use App\Entity\Branch;
use App\Entity\Department;
use App\Entity\Employee;
use App\Entity\EmpData;
use App\Entity\JobTitle;
use App\Entity\Leave;
use App\Entity\PayGrade;
use App\Form\ReportsForm\ReportBranchType;
use App\Form\ReportsForm\ReportDeptType;
use App\Form\ReportsForm\ReportJobTitleType;
use App\Form\ReportsForm\ReportLeavesType;
use App\Form\ReportsForm\ReportPayGradeType;
use App\Model\BranchModel;
use App\Model\DepartmentModel;
use App\Model\EmployeeModel;
use App\Model\EmploymentStatusModel;
use App\Model\EmpTelephoneModel;
use App\Model\EmpCustomModel;
use App\Model\EmpDataModel;
use App\Model\JobTitleModel;
use App\Model\LeaveModel;
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
        $dept = new Department();
        $jobTitle = new JobTitle();
        $payGrade = new PayGrade();
        $leave = new Leave();
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
         $jobTitles = $jobTitleModel->getAllJobTitles($entityManager);
         $jobTitleChoices;
         foreach($jobTitles as &$jobTitle1){
             $jobTitleChoices[$jobTitle1['job_title']] = $jobTitle1['job_title'];
             
         }
        // //payGrade
         $payGrades = $payGradeModel->getAllPayGrades($entityManager);
         $payGradeChoices;
         foreach($payGrades as &$payGrade1){
             $payGradeChoices[$payGrade1['pay_grade']] = $payGrade1['pay_grade'];
         }
        // //employment Status
         $empStatuses = $employmentStatusModel->getAllEmploymentStatuses($entityManager);
         $empStatusChoices;
         foreach($empStatuses as &$empStatus){
             $empStatusChoices[$empStatus['id'].'-'.$empStatus['emp_status']] = $empStatus['emp_status'];
         }
        $formBranch = $this->createForm(ReportBranchType::class, $branch, array(
            'branch_choices' =>$branchChoices,
        )); 
        
        $formDept = $this->createForm(ReportDeptType::class, $dept, array(
            'dept_choices' =>$deptChoices,
        )); 

        $formJobTitle = $this->createForm(ReportJobTitleType::class, $jobTitle, array(
            'jobTitle_choices' =>$jobTitleChoices,
        ));
        
        $formPayGrade = $this->createForm(ReportPayGradeType::class, $payGrade, array(
            'payGrade_choices' =>$payGradeChoices,
        )); 

        $formLeaves = $this->createForm(ReportLeavesType::class, $leave, array(
            'dept_choices' =>$deptChoices,
        )); 


        $formBranch->handleRequest($request);
        if ($formBranch->isSubmitted() && $formBranch->isValid()) {
            $branchId = $branch->getBranchId();
            return $this->redirectToRoute('report_branch', array('branchId' =>$branchId));
        }

        $formDept->handleRequest($request);
        if ($formDept->isSubmitted() && $formDept->isValid()) {
            $deptId = $dept->getDeptId();
            return $this->redirectToRoute('report_dept', array('deptId' =>$deptId));
        }

        // $formJobTitle->handleRequest($request);
        // if ($formJobTitle->isSubmitted() && $formJobTitle->isValid()) {
        //     $jobTitleId = $jobTitle->getJobTitleId();
        //     return $this->redirectToRoute('report_jobTitle', array('jobTitleId' =>$jobTitleId));
        // }

        $formJobTitle->handleRequest($request);
        if ($formJobTitle->isSubmitted() && $formJobTitle->isValid()) {
            $jobTitleId = $jobTitleModel->getJobTitleId($jobTitle->getJobTitle(), $entityManager);
            return $this->redirectToRoute('report_jobTitle', array('jobTitleId' =>$jobTitleId));
        }

        $formPayGrade->handleRequest($request);
        if ($formPayGrade->isSubmitted() && $formPayGrade->isValid()) {
            $payGrade2 = $payGrade->getPayGrade();
            return $this->redirectToRoute('report_payGrade', array('payGrade' =>$payGrade2));
        }

        $formLeaves->handleRequest($request);
        if ($formLeaves->isSubmitted() && $formLeaves->isValid()) {
            $deptId = $formLeaves->get('deptId')->getData();
            $beginDate1 = $formLeaves->get('beginDate')->getData();
            $endDate1 = $formLeaves->get('endDate')->getData();
            $beginDate = $beginDate1->format('Y-m-d');
            $endDate = $endDate1->format('Y-m-d');
            return $this->redirectToRoute('report_leaves', array('deptId' =>$deptId,'beginDate' =>$beginDate, 'endDate' =>$endDate));
        }

        return $this->render('report/index.html.twig', [
            'form_dept' => $formDept->createView(),
            'form_branch' => $formBranch->createView(),
            'form_jobTitle' => $formJobTitle->createView(),
            'form_payGrade' => $formPayGrade->createView(),
            'form_leaves' => $formLeaves->createView()
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
        $branch = $branchModel->getBranchName($branchId,$entityManager);
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
            'branch' => $branch
        ]);
    }
    
    /**
     * @Route("/dept/{deptId}", name="report_dept", methods={"GET"})
     */
    public function showEmpByDepartment($deptId): Response
    {
        $employeeModel = new EmployeeModel();
        $branchModel = new BranchModel();
        $deptModel = new DepartmentModel();
        $reportModel = new ReportModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $reportModel->getEmpByDepartment($deptId, $entityManager);
        $deptName = $deptModel->getDepartmentName($deptId, $entityManager);
        //var_dump($leaves);exit;
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
            'deptName' => $deptName[0]['dept_name']
        ]);
    }

    /**
     * @Route("/jobTitle/{jobTitleId}", name="report_jobTitle", methods={"GET"})
     */
    public function showEmpByJobTitle($jobTitleId): Response
    {
        $employeeModel = new EmployeeModel();
        $branchModel = new BranchModel();
        $reportModel = new ReportModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $reportModel->getEmpByJobTitle($jobTitleId, $entityManager);
        //changing job title id and emp status id to job title and emp status
        $jobTitleModel = new JobTitleModel();
        $title = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
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


        return $this->render('report/jobTitle.html.twig', [
            'employees' => $employees,
            'jobTitle' => $title
        ]);
    }

    /**
     * @Route("/payGrade/{payGrade}", name="report_payGrade", methods={"GET"})
     */
    public function showEmpByPayGrade($payGrade): Response
    {
        $employeeModel = new EmployeeModel();
        $branchModel = new BranchModel();
        $reportModel = new ReportModel();
        $entityManager = $this->getDoctrine()->getManager();
        $employees = $reportModel->getEmpByPayGrade($payGrade, $entityManager);
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


        return $this->render('report/payGrade.html.twig', [
            'employees' => $employees,
            'payGrade' => $payGrade
        ]);
    }

    /**
     * @Route("/leaves/{deptId}/{beginDate}/{endDate}", name="report_leaves", methods={"GET"})
     */
    public function showLeaves($deptId,$beginDate, $endDate): Response
    {
        $employeeModel = new EmployeeModel();
        $deptModel = new DepartmentModel();
        $reportModel = new ReportModel();
        $entityManager = $this->getDoctrine()->getManager();
        $deptName = $deptModel->getDepartmentName($deptId, $entityManager);
        $leaves = $reportModel->getLeavesForPeriodByDept($deptId, $beginDate, $endDate, $entityManager);
        //changing job title id and emp status id to job title and emp status
        
        return $this->render('report/leaves.html.twig', [
            'leaves' => $leaves,
            'beginDate' => $beginDate, 
            'endDate' => $endDate,
            'deptName' => $deptName[0]['dept_name']
        ]);
    }
    
}
