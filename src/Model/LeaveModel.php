<?php
namespace App\Model;

class LeaveModel{

    public function getAllLeaves($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM leaves ORDER BY emp_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function addLeave($leave, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO leaves (emp_id,from_date, till_date, leave_type) VALUES(:emp_id,:from_date, :till_date, :leave_type)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $leave->getEmpId());
        $stmt->bindValue(':from_date', $leave->getFromDate()->format('Y-m-d'));
        $stmt->bindValue(':till_date', $leave->getTillDate()->format('Y-m-d'));
        $stmt->bindValue(':leave_type', $leave->getLeaveType());
        $stmt->execute();

    }

    // public function changeLeaveLimit($leaveLimit, $em){
    //     $conn = $em->getConnection();
    //     $sql = "UPDATE leave_limit SET leave_limit = :leave_limit WHERE pay_grade = :pay_grade and leave_type = :leave_type ";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindValue(':pay_grade', $leaveLimit->getPayGrade());
    //     $stmt->bindValue(':leave_type', $leaveLimit->getLeaveType());
    //     $stmt->bindValue(':leave_limit', $leaveLimit->getLeaveLimit());
    //     $stmt->execute();

    // }

    public function deleteLeave($leave, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM leaves WHERE leave_form_id = :leave_form_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':leave_form_id', $leave->getLeaveFormId());
        $stmt->execute();
    }

    public function getEmpLeaves($empId,$em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM leaves  WHERE emp_id = :emp_id ORDER BY leave_form_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empId);
        $stmt->execute();
        return $stmt->fetchAll();

    }
}