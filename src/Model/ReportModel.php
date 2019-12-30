<?php
namespace App\Model;

class ReportModel{

    public function getEmpByBranch($branch, $em){
        $conn = $em->getConnection();
        $sql = "SELECT emp_id, name,job_title_id FROM employee where branch_id = :branch_id ORDER BY emp_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':branch_id',$branch->getBranchID());
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

