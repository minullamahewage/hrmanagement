<?php
namespace App\Model;

class LeaveTypeModel {

    public function getAllLeaveTypes($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM leave_type ORDER BY leave_type ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt-> fetchAll();
    }

    public function addLeaveType($leaveType, $em)
    {
        $conn = $em->getConnection();        
        $sql = "INSERT INTO leave_type (leave_type) VALUES (:leave_type)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':leave_type', $leaveType->getLeaveType());
        $stmt->execute();
    }

    public function deleteLeaveType($leaveType,$em){
        $conn = $em->getConnection();        
        $sql = "DELETE FROM leave_type WHERE leave_type = :leave_type";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':leave_type', $leaveType->getLeaveType());
        $stmt->execute();
    }
}

