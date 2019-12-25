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

    //get employee leave form details
    public function getEmpLeaves($empId,$em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM leaves  WHERE emp_id = :emp_id ORDER BY leave_form_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empId);
        $stmt->execute();
        return $stmt->fetchAll();

    }
    //check if employee has enough remaining leaves
    public function checkRemLeaves($empId, $leaveType,$em){
        $conn = $em->getConnection();
        $sql = "SELECT leaves_remaining FROM leaves_remaining WHERE emp_id = :emp_id AND leave_type = :leave_type";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empId);
        $stmt->bindValue(':leave_type', $leaveType);
        $stmt->execute();
        return $stmt->fetchAll()[0]['leaves_remaining'];
    }

    //get remaining leaves for an employee
    public function getEmpRemLeaves($empId,$em){
        $conn = $em->getConnection();
        $sql = "SELECT leave_type, leave_limit, leaves_taken, leaves_remaining FROM leaves_remaining WHERE emp_id = :emp_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //get leave requests for a supervisor
    public function getLeaveRequests($supId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT leaves.leave_form_id, leaves.emp_id, leaves.from_date, leaves.till_date, leaves.leave_type, leaves.approval_status FROM leaves, supervisor WHERE leaves.emp_id = supervisor.emp_id AND leaves.approval_status = 'Pending' AND supervisor.supervisor_id = :sup_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':sup_id', $supId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //supervisor approve leave
    public function approveLeave($leaveFormId, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE leaves SET approval_status = 'True' WHERE leave_form_id = :leave_form_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':leave_form_id', $leaveFormId);
        $stmt->execute();
    }

    //supervisor deny leave
    public function denyLeave($leaveFormId, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE leaves SET approval_status = 'False' WHERE leave_form_id = :leave_form_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':leave_form_id', $leaveFormId);
        $stmt->execute();
    }
}