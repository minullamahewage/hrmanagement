<?php
namespace App\Model;

class PayGradeModel {

    public function getAllPayGrades($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM pay_grade ORDER BY pay_grade ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt-> fetchAll();
    }

    public function addPayGrade($payGrade, $em)
    {
        $conn = $em->getConnection();        
        $sql = "INSERT INTO pay_grade (pay_grade) VALUES (:pay_grade)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':pay_grade', $payGrade->getPayGrade());
        $stmt->execute();
    }

    public function deletePayGrade($payGrade,$em){
        $conn = $em->getConnection();        
        $sql = "DELETE FROM pay_grade WHERE pay_grade = :pay_grade";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':pay_grade', $payGrade->getPayGrade());
        $stmt->execute();
    }
    
}

