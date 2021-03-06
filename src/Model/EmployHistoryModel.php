<?php

namespace App\Model;

class EmployHistoryModel{

    public function getAllEmployHistories($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM employ_history ORDER BY emp_history_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addEmployHistory($employHistory, $em){
        $conn =$em->getConnection();
        $sql = "INSERT INTO employ_history(emp_id, to_date, from_date, emp_status_id) VALUES (:emp_id, :to_date, :from_date, :emp_status_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $employHistory->getEmpId());
        $stmt->bindValue(':to_date',$employHistory->getToDate()->format('Y-m-d'));
        $stmt->bindValue(':from_date', $employHistory->getFromDate()->format('Y-m-d'));
        $stmt->bindValue(':emp_status_id', $employHistory->getEmpStatusId());
        $stmt->execute();
    }

    public function changeEmployHistory($employHistory, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE employ_history SET emp_id = :emp_id, to_date = :to_date, from_date = :from_date, emp_status_id = :emp_status_id WHERE emp_history_id = :emp_history_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $employHistory->getEmpId());
        $stmt->bindValue(':to_date', $employHistory->getToDate()->format('Y-m-d'));
        $stmt->bindValue(':from_date', $employHistory->getFromDate()->format('Y-m-d'));
        $stmt->bindValue(':emp_status_id', $employHistory->getEmpStatusId());
        $stmt->execute();
    }

    public function getEmployHistory($empId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employ_history where emp_id = :emp_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteEmployHistory($empHistory, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM employ_history where emp_history_id = :emp_history_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_history_id',$empHistory->getEmpHistoryId());
        $stmt->execute();
    }

}