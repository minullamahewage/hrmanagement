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
        $sql = "INSERT INTO employ_history(emp_id, to, from, emp_status) VALUES (:emp_id, :to, :from, :emp_status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $employHistory->getEmpId());
        $stmt->bindValue(':to',$employHistory->getTo());
        $stmt->bindValue(':from', $employHistory->getFrom());
        $stmt->bindValue(':emp_status', $employHistory->getEmpStatus());
        $stmt->execute();
    }

    public function changeEmployHistory($employHistory, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE employ_history SET emp_id = :emp_id, to = :to, from = :from, emp_status = :emp_status WHERE emp_history_id = :emp_history_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $employHistory->getEmpId());
        $stmt->bindValue(':to', $employHistory->getTo());
        $stmt->bindValue(':from', $employHistory->getFrom());
        $stmt->bindValue(':emp_status', $employHistory->getEmpStatus());
        $stmt->execute();
    }

    public function getEmpEmployHistory($empID, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employ_history where emp_id = :emp_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_ID', $empID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteEmployHistory($empHistoryID, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM employ_history where emp_history_id = :emp_history_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_history_ID',$empHistoryID);
        $stmt->execute();
    }

}