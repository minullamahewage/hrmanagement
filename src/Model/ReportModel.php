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
        $sql = "SELECT * FROM employee where pay_grade = :payGrade ORDER BY emp_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':payGrade',$payGrade);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLeavesForPeriodByDept($deptId, $begin, $end, $em){ 
        $conn = $em->getConnection();
        $sql = "SELECT * FROM leaves where emp_id IN (SELECT emp_id from employee where dept_id = :deptId) AND (from_date BETWEEN :begin AND :end OR till_date BETWEEN :begin AND :end)";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':deptId',$deptId);
        $stmt->bindValue(':begin',$begin);
        $stmt->bindValue(':end',$end);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

