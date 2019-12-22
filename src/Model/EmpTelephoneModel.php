<?php

namespace App\Model;

class EmpTelephoneModel{

    public function getAllEmpTelephones($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM emp_telephone ORDER BY emp_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addEmpTelephone($empTelephone, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO emp_telephone (emp_id,telephone) VALUES (:emp_ID, :emp_tel)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_ID', $empTelephone->getEmpId());
        $stmt->bindValue(':emp_tel', $empTelephone->getTelephone());
        $stmt->execute();
    }

    public function deleteEmpTelephone($empTelephone, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM emp_telephone WHERE telephone = :emp_tel ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_tel', $empTelephone->getTelephone());
        $stmt->execute();

    }
    public function getEmpTelephone($empID, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM emp_telephone where emp_id = :emp_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_ID', $empID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}