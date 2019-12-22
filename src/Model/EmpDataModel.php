<?php

namespace App\Model;

class EmpDataModel{

    public function getAllEmpData($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM emp_data ORDER BY emp_id, attribute ASC";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addEmpData($empData, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO emp_data (emp_id, attribute, value) VALUES (:emp_id,:attribute, :value)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empData->getEmpId());
        $stmt->bindValue(':attribute', $empData->getAttribute());
        $stmt->bindValue(':value', $empData->getValue());
        $stmt->execute();
    }

    public function changeEmpData($empData, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE emp_data SET value=:value WHERE emp_id = :emp_id and attribute = :attribute ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':value', $empData->getValue());
        $stmt->bindValue(':emp_id', $empData->getEmpId());
        $stmt->bindValue(':attribute', $empData->getAttribute());
        $stmt->execute();
    }

    public function deleteEmpData($empData, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM emp_data WHERE emp_id = :emp_id and attribute = :attribute ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $empData->getEmpId());
        $stmt->bindValue(':attribute', $empData->getAttribute());
        $stmt->execute();
    }

    public function getDataByEmpId($empID, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM emp_data where emp_id = :emp_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_ID', $empID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDataByAttribute($attribute, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM emp_data where attribute = :attribute";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':attribute', $attribute);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}