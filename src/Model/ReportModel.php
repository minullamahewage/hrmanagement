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
}

