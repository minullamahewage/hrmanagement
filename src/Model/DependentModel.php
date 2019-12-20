<?php

namespace App\Model;

class DependentModel{

    public function getAllDependants($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM dependent ORDER BY dependent ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addDependent($dependent , $em){
        $conn =$em->getConnection();
        $sql = "INSERT INTO dependent(nic, emp_id, name, email, relationship, telephone, addr_line_1, addr_line_2, city, country, postal_code) VALUES (:nic, :emp_id, :name, :email, :relationship, :telephone, :addr_line_1, :addr_line_2, :city, :country, :postal_code)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nic', $dependent->getNic());
        //gahapiya ithuru tika

        $stmt->execute();
    }

    public function changeDependentDetails($dependent, $em){
        $conn = $em->getConnection();
        //complete
        $sql = "UPDATE dependent SET  WHERE dependent_id = :dependent_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nic', $dependent->getNic());


        $stmt->execute();
    }

}