<?php

namespace App\Model;

class EmergencyContactModel {

    public function getAllEmergencyContacts($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM emergency_contact ORDER BY emp_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt-> fetchAll();
    }

    public function addEmergencyContact($emergencyContact, $em)
    {
        $conn = $em->getConnection();
        $sql = "INSERT INTO emergency_contact(emp_id,name, telephone) VALUES (:emp_id,:name, :telephone)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $emergencyContact->getEmpId());
        $stmt->bindValue(':name', $emergencyContact->getName());
        $stmt->bindValue(':telephone', $emergencyContact->getTelephone());
        $stmt->execute();
    }

    public function changeEmergencyContact($emergencyContact,$em){
        $conn= $em->getConnection();
        $sql="UPDATE emergency_contact SET emp_id = :emp_id, name = :name, telephone = :telephone WHERE id= :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $emergencyContact->getId());
        $stmt->bindValue(':emp_id', $emergencyContact->getEmpId());
        $stmt->bindValue(':name', $emergencyContact->getName());
        $stmt->bindValue(':telephone', $emergencyContact->getTelephone());
        $stmt->execute();

    }

    public function deleteEmergencyContact($emergencyContact, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM emergency_contact WHERE id = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $emergencyContact->getId());
        $stmt->execute();
    }

    public function getEmpEmergencyContacts($emp_id, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM emergency_contact WHERE emp_id = :emp_id ORDER BY name ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_id', $emp_id);
        $stmt->execute();
        return $stmt-> fetchAll();
    }
}

