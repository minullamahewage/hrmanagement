<?php

namespace App\Model;

class EmpCustomModel{

    public function getAllCustomAttributes($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM emp_custom ORDER BY attribute ASC";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addCustomAttribute($empCustom, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO emp_custom (attribute) VALUES (:attribute)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':attribute', $empCustom->getAttribute());
        $stmt->execute();
    }

    public function deleteCustomAttribute($empCustom, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM emp_custom WHERE attribute = :attribute ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':attribute', $empCustom->getAttribute());
        $stmt->execute();

    }
}
