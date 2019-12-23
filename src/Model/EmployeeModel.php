<?php
namespace App\Model;

class EmployeeModel{

    public function getAllEmployees($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employee ORDER BY emp_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addEmployee($employee, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO employee (emp_id, NIC, name, email, addr_line_1, addr_line_2, city, country, postal_code, dob, marital_status, branch_id, dept_id, job_title_id, pay_grade, emp_status_id, supervisor_id) VALUES (:emp_id, :NIC, :name, :email, :addr_line_1, :addr_line_2, :city, :country, :postal_code, :dob, :marital_status, :branch_id, :dept_id, :job_title_id, :pay_grade, :emp_status_id, :supervisor_id) ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $employee->getEmpId());
        $stmt->bindValue(':NIC', $employee->getNic());
        $stmt->bindValue(':name', $employee->getName());
        $stmt->bindValue(':email', $employee->getEmail());
        $stmt->bindValue(':addr_line_1', $employee->getAddrLine1());
        $stmt->bindValue(':addr_line_2', $employee->getAddrLine2());
        $stmt->bindValue(':city', $employee->getCity());
        $stmt->bindValue(':country', $employee->getCountry());
        $stmt->bindValue(':postal_code', $employee->getPostalCode());
        $stmt->bindValue(':dob', $employee->getDob()->format('Y-m-d'));
        $stmt->bindValue(':marital_status', $employee->getMaritalStatus());
        $stmt->bindValue(':branch_id', $employee->getBranchId());
        $stmt->bindValue(':pay_grade', $employee->getPayGrade());
        $stmt->bindValue(':supervisor_id', $employee->getSupervisorId());
        $stmt->bindValue(':dept_id', $employee->getDeptId());
        $stmt->bindValue(':emp_status_id', $employee->getEmpStatusId());
        $stmt->bindValue(':job_title_id', $employee->getJobTitleId());
        $stmt->execute();
    }

    public function changeEmployee($employee, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE employee SET emp_id = :emp_id, 
            NIC= :NIC, name = :name, 
            email = :email, addr_line_1 = :addr_line_1, 
            addr_line_2 = :addr_line_2, city = :city, 
            country = :country, postal_code = :postal_code, 
            dob = :dob, marital_status = :marital_status, 
            branch_id = :branch_id, dept_id = :dept_id, 
            job_title_id = :job_title_id, pay_grade = :pay_grade, 
            emp_status_id = :emp_status_id, supervisor_id = :supervisor_id
            WHERE emp_id = :emp_id ; ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $employee->getEmpId());
        $stmt->bindValue(':NIC', $employee->getNic());
        $stmt->bindValue(':name', $employee->getName());
        $stmt->bindValue(':email', $employee->getEmail());
        $stmt->bindValue(':addr_line_1', $employee->getAddrLine1());
        $stmt->bindValue(':addr_line_2', $employee->getAddrLine2());
        $stmt->bindValue(':city', $employee->getCity());
        $stmt->bindValue(':country', $employee->getCountry());
        $stmt->bindValue(':postal_code', $employee->getPostalCode());
        $stmt->bindValue(':dob', $employee->getDob()->format('Y-m-d'));
        $stmt->bindValue(':marital_status', $employee->getMaritalStatus());
        $stmt->bindValue(':branch_id', $employee->getBranchId());
        $stmt->bindValue(':pay_grade', $employee->getPayGrade());
        $stmt->bindValue(':supervisor_id', $employee->getSupervisorId());
        $stmt->bindValue(':dept_id', $employee->getDeptId());
        $stmt->bindValue(':emp_status_id', $employee->getEmpStatusId());
        $stmt->bindValue(':job_title_id', $employee->getJobTitleId());
        $stmt->execute();
    }

    public function deleteEmployee($employee, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM employee where emp_id = :emp_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id',$employee->getEmpId());
        $stmt->execute();
    }

    public function getSubordinates($empId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT employee.* FROM employee, supervisor WHERE employee.emp_id = supervisor.emp_id AND supervisor.supervisor_id = :emp_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}