<?php

namespace App\Model;

class BranchModel{

    public function getAllBranches($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM branch ORDER BY branch_id ASC";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addBranch($branch, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO branch (branch_id, name, line_1, line_2, city, country, postal_code) VALUES (:branch_id,:name, :line_1, :line_2, :city, :country, :postal_code)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':branch_id', $branch->getBranchId());
        $stmt->bindValue(':name', $branch->getName());
        $stmt->bindValue(':line_1', $branch->getLine1());
        $stmt->bindValue(':line_2', $branch->getLine2());
        $stmt->bindValue(':city', $branch->getCity());
        $stmt->bindValue(':country', $branch->getCountry());
        $stmt->bindValue(':postal_code', $branch->getPostalCode());
        $stmt->execute();
    }

    public function deleteBranch($branch, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM branch WHERE branch_id = :branch_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':branch_id', $branch->getBranchId());
        $stmt->execute();

    }

    public function getBranchName($branchId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT name from branch WHERE branch_id = :branchId";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':branchId' , $branchId);
        $stmt->execute();
        return $stmt->fetchAll()[0]['name'];

    }

    // public function getBranch($branch_id, $em){
    //     $conn = $em->getConnection();
    //     $sql = "SELECT brnach"

    // }

}
