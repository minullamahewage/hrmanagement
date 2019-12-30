<?php

namespace App\Controller;

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
 * @Route("/employee")
 */
class EmployeeController extends AbstractController
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
     * @Route("/admin/new", name="employee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $employee = new Employee();
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
        $form = $this->createForm(EmployeeType::class, $employee, array(
            'branch_choices' =>$branchChoices,
            'dept_choices' =>$deptChoices,
            'jobTitle_choices' => $jobTitleChoices,
            'payGrade_choices' => $payGradeChoices,
            'empStatus_choices' => $empStatusChoices,
        ));

        //adding fields for custom attributes
        $cusAttr = $empCustomModel->getAllCustomAttributes($entityManager);
        foreach($cusAttr as $customAttribute){
            $form->add($customAttribute['attribute'], TextType::class, array(
                "mapped" => false,
                "required" =>false,   
            ));
        }        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            //Getting job title id from job title for sql
            $jobTitle = $employee->getJobTitle();
            $jobTitleId = $jobTitleModel->getJobTitleId($jobTitle, $entityManager);
            $employee->setJobTitleId(strval($jobTitleId));
            //Getting employment status id from employment status           
            $empStatus = $employee->getEmpStatus();
            $empStatusId = $employmentStatusModel->getEmploymentStatusId($empStatus, $entityManager);
            $employee->setEmpStatusId(strval($empStatusId));
            //adding employee to db
            $employeeModel->addEmployee($employee, $entityManager);
            //adding custom attribute data to db
            foreach($cusAttr as $customAttribute){
                $cusAttrData = $form->get($customAttribute['attribute'])->getData();
                $empData = new EmpData();
                $empData->setEmpId($employee->getEmpId());
                $empData->setAttribute($customAttribute['attribute']);
                $empData->setValue($cusAttrData);
                $empDataModel->addEmpData($empData, $entityManager);
            }
            return $this->redirectToRoute('employee_index');
        }

        return $this->render('employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    //admin employee details edit
    /**
     * @Route("/admin/{empId}/edit", name="employee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employee $employee): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $employeeModel = new EmployeeModel();
        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        $empTelephoneModel = new EmpTelephoneModel();
        $empCustomModel = new EmpCustomModel();
        $empDataModel = new EmpDataModel();
        $branchModel = new BranchModel();
        $deptModel = new DepartmentModel();
        $jobTitleModel = new JobTitleModel();
        $payGradeModel = new PayGradeModel();
        $employmentStatusModel = new EmploymentStatusModel();
        //changing job title id  job title       
        $jobTitleId = $employee->getJobTitleId();
        $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
        $employee->setJobTitle($jobTitle);
        //changing  emp status id to emp status
        $empStatusId = $employee->getEmpStatusId();
        $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
        $employee->setEmpStatus($empStatus);

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
        $form = $this->createForm(EmployeeType::class, $employee, array(
            'branch_choices' =>$branchChoices,
            'dept_choices' =>$deptChoices,
            'jobTitle_choices' => $jobTitleChoices,
            'payGrade_choices' => $payGradeChoices,
            'empStatus_choices' => $empStatusChoices,
        ));
        
        $cusAttr = $empCustomModel->getAllCustomAttributes($entityManager);
        foreach($cusAttr as $customAttribute){
            $cusAttrData = $empDataModel->getEmpValueAttribute($employee->getEmpId(), $customAttribute['attribute'],  $entityManager);
            // var_dump($cusAttrData); exit;
            $form->add($customAttribute['attribute'], TextType::class, array(
                "mapped" => false,
                "required" =>false,
                "data" =>  $cusAttrData[0]['value'], 
            ));
        }      
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //Getting job title id from job title for sql
            $jobTitle = $employee->getJobTitle();
            $jobTitleId = $jobTitleModel->getJobTitleId($jobTitle, $entityManager);
            $employee->setJobTitleId(strval($jobTitleId));
            //Getting employment status id from employment status
            $empStatus = $employee->getEmpStatus();
            $empStatusId = $employmentStatusModel->getEmploymentStatusId($empStatus, $entityManager);
            $employee->setEmpStatusId(strval($empStatusId));
            $employeeModel->changeEmployee($employee, $entityManager);

            //changing custom attribute data on db
            foreach($cusAttr as $customAttribute){
                $cusAttrData = $form->get($customAttribute['attribute'])->getData();
                $empData = new EmpData();
                $empData->setEmpId($employee->getEmpId());
                $empData->setAttribute($customAttribute['attribute']);
                $empData->setValue($cusAttrData);
                $empDataModel->changeEmpData($empData, $entityManager);
            }

            return $this->redirectToRoute('employee_index');
        }

        return $this->render('employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }


    

    

    

    //admin employee delete
    /**
     * @Route("/admin/{empId}", name="employee_delete", methods={"DELETE"})
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

    //admin show individual employee details
    /**
     * @Route("/admin/{empId}", name="admin_show", methods={"GET"})
     */
    public function showAdmin(Employee $employee): Response
    {
        $empId = $employee->getEmpId();
        $entityManager = $this->getDoctrine()->getManager();
        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        $empTelephoneModel = new EmpTelephoneModel();
        $empDataModel = new EmpDataModel();
        //changing job title id and emp status id to job title and emp status       
        //job title
        $jobTitleId = $employee->getJobTitleId();
        $jobTitle = $jobTitleModel->getJobTitle($jobTitleId, $entityManager);
        $employee->setJobTitle($jobTitle);
        //emply status
        $empStatusId = $employee->getEmpStatusId();
        $empStatus = $empStatusModel->getEmploymentStatus($empStatusId, $entityManager);
        $employee->setEmpStatus($empStatus);
        //emp telephone
        $empTelephone = $empTelephoneModel->getEmpTelephone($empId, $entityManager);
        //emp custom attributes
        $customData = $empDataModel->getDataByEmpId($empId, $entityManager);
        // var_dump($customData); exit;
        return $this->render('employee/show_admin.html.twig', [
            'employee' => $employee,
            'emp_telephone' => $empTelephone,
            'custom_data' => $customData,
        ]);
    }

    //employee show personal details
    /**
     * @Route("/", name="employee_show", methods={"GET"})
     */
    public function show(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $empId = $user->getEmpId();
        // var_dump($empId); exit;
        $employeeModel = new EmployeeModel();
        
        $entityManager = $this->getDoctrine()->getManager();
        $employee = $employeeModel->getEmployee($empId, $entityManager);
        $jobTitleModel = new JobTitleModel();
        $empStatusModel = new EmploymentStatusModel();
        $empTelephoneModel = new EmpTelephoneModel();
        $empDataModel = new EmpDataModel();
        //changing job title id and emp status id to job title and emp status
        
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
        //emp custom attributes
        $customData = $empDataModel->getDataByEmpId($empId, $entityManager);
        //check if supervisor
        $employeeModel = new EmployeeModel();
        if(count($employeeModel->getSubordinates($empId, $entityManager))){
            return $this->render('employee/show_sup.html.twig', [
                'employee' => $employee,
                'emp_telephone' => $empTelephone,
                'custom_data' => $customData,
            ]);

        }
        else{
            return $this->render('employee/show.html.twig', [
                'employee' => $employee,
                'emp_telephone' => $empTelephone,
                'custom_data' => $customData,
            ]);
        }
    }

    //supervisor view subordinates
    /**
     * @Route("/subordinate/", name="employee_subordinate", methods={"GET"})
     */
    public function showSubordinates(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $empId = $user->getEmpId();
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
            'emp_id' =>$empId
        ]);
    }
}
