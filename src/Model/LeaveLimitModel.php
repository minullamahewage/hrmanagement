<?php
namespace App\Model;

class LeaveLimitModel{

    public function getAllLeaveLimits($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM leave_limit ORDER BY pay_grade ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function addLeaveLimit($leaveLimit, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO leave_limit (pay_grade, leave_type, leave_limit) VALUES(:pay_grade, :leave_type, :leave_limit)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':pay_grade', $leaveLimit->getPayGrade());
        $stmt->bindValue(':leave_type', $leaveLimit->getLeaveType());
        $stmt->bindValue(':leave_limit', $leaveLimit->getLeaveLimit());
        $stmt->execute();

    }

    public function changeLeaveLimit($leaveLimit, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE leave_limit SET leave_limit = :leave_limit WHERE pay_grade = :pay_grade and leave_type = :leave_type ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':pay_grade', $leaveLimit->getPayGrade());
        $stmt->bindValue(':leave_type', $leaveLimit->getLeaveType());
        $stmt->bindValue(':leave_limit', $leaveLimit->getLeaveLimit());
        $stmt->execute();

    }

    public function deleteLeaveLimit($leaveLimit, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM leave_limit WHERE pay_grade = :pay_grade and leave_type = :leave_type ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':pay_grade', $leaveLimit->getPayGrade());
        $stmt->bindValue(':leave_type', $leaveLimit->getLeaveType());
        $stmt->execute();
    }
}