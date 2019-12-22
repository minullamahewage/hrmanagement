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
        $sql = "INSERT INTO employee (emp_id, NIC, name, email, addr_line_1, addr_line_2, city, country, potal_code, dob, marital_status, branch_id, dept_id, job_title_id, pay_grade, emp_status_id, supervisor_id) VALUES (:emp_id, :NIC, :name, :email, :addr_line_1, :addr_line_2, :city, :country, :potal_code, :dob, :marital_status, :branch_id, :dept_id, :job_title_id, :pay_grade, :emp_status_id, :supervisor_id) ";
    }

}