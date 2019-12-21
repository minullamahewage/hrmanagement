<?php
namespace App\Model;

class EmploymentStatusModel {

    public function getAllEmploymentStatus($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM employment_status ORDER BY emp_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt-> fetchAll();
    }

    public function addemploymentStatus($employmentStatus, $em)
    {
        $conn = $em->getConnection();
        $sql = "INSERT INTO employment_status(emp_status) VALUES (:emp_status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_status', $employmentStatus->getEmpStatus());
        $stmt->execute();
    }

    // public function changeEmploymentStatus($employmentStatus,$em){
    //     $conn= $em->getConnection();
    //     $sql="UPDATE employment_status SET emp_status = :emp_status WHERE id= :id";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindValue(':id', $emergencyContact->getId());
    //     $stmt->bindValue(':emp_id', $emergencyContact->getEmpId());
    //     $stmt->bindValue(':name', $emergencyContact->getName());
    //     $stmt->bindValue(':telephone', $emergencyContact->getTelephone());
    //     $stmt->execute();

    // }

    public function deleteEmploymentStatus($employmentStatus, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM employment_status WHERE emp_status = :emp_status ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':emp_status', $employmentStatus->getEmpStatus());
        $stmt->execute();
    }

    public function getEmploymentStatus($id, $em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM employment_status WHERE id = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt-> fetchAll();
    }
}