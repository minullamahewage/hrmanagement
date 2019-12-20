<?php

namespace App\Model;

class DependentModel{

    public function getAllDependents($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM dependent ORDER BY emp_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addDependent($dependent , $em){
        $conn =$em->getConnection();
        $sql = "INSERT INTO dependent(nic, emp_id, name, email, relationship, telephone, addr_line_1, addr_line_2, city, country, postal_code) VALUES (:nic, :emp_id, :name, :email, :relationship, :telephone, :addr_line_1, :addr_line_2, :city, :country, :postal_code)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nic', $dependent->getNic());
        $stmt->bindValue(':emp_id', $dependent->getEmpId());
        $stmt->bindValue(':name',$dependent->getName());
        $stmt->bindValue(':email', $dependent->getEmail());
        $stmt->bindValue(':relationship', $dependent->getRelationship());
        $stmt->bindValue(':telephone', $dependent->getTelephone());
        $stmt->bindValue(':addr_line_1',$dependent->getAddrLine1());
        $stmt->bindValue(':addr_line_2', $dependent->getAddrLine1());
        $stmt->bindValue(':city', $dependent->getCity());
        $stmt->bindValue(':country',$dependent->getCountry());
        $stmt->bindValue(':postal_code', $dependent->getPostalCode());
        $stmt->execute();
    }

    public function changeDependentDetails($dependent, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE dependent SET  nic = :nic, emp_id = :emp_id, name = :name, email = :email, relationship = :relationship, telephone = :telephone, addr_line_1 = :addr_line_1, addr_line_2 = :addr_line_2, city = :city, country = :country, postal_code = :postal_code WHERE dependent_id = :dependent_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nic', $dependent->getNic());
        $stmt->bindValue(':emp_id', $dependent->getEmpId());
        $stmt->bindValue(':name',$dependent->getName());
        $stmt->bindValue(':email', $dependent->getEmail());
        $stmt->bindValue(':relationship', $dependent->getRelatioship());
        $stmt->bindValue(':telephone', $dependent->getTelephone());
        $stmt->bindValue(':addr_line_1',$dependent->getAddrLine1());
        $stmt->bindValue(':addr_line_2', $dependent->getAddrLine1());
        $stmt->bindValue(':city', $dependent->getCity());
        $stmt->bindValue(':country',$dependent->getCountry());
        $stmt->bindValue(':postal_code', $dependent->getPostalCode());
        $stmt->execute();
    }

    public function getEmpDependent($empID, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM dependent where emp_id = :emp_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_ID', $empID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteDependent($dependentID, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM dependent where dependent_id = :dependent_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':dependent_ID',$dependentID);
        $stmt->execute();
    }

}