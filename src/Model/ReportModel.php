<?php
namespace App\Model;

class ReportModel{

    public function getEmpByBranch($branchId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employee where branch_id = :branch_id ORDER BY emp_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':branch_id',$branchId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getEmpByDepartment($departmentId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employee where dept_id = :department_id ORDER BY emp_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':department_id',$departmentId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getEmpByJobTitle($jobTitleId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employee where job_title_id = :jobTitle_id ORDER BY emp_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':jobTitle_id',$jobTitleId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getEmpByPayGrade($payGrade, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employee where payGrade = :payGrade ORDER BY emp_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':payGrade',$payGrade);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

