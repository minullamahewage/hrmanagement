<?php

namespace App\Model;

class UserModel {

    public function getAllUsers($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM user ORDER BY username ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt-> fetchAll();
    }

    public function addUser($user, $em)
    {
        // $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        // $date=$task->getDate()->format('Y-m-d H:i:s');
        $sql = "INSERT INTO user (username, password, emp_id, type) VALUES (:username, :password, :emp_id, :type)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':emp_id', $user->getEmpId());
        $stmt->bindValue(':type', $user->getType());
        $stmt->execute();
        // return $stmt-> fetchAll();
    }

    public function deleteUser($userId, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM user WHERE id = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':userId' , $userId);
        $stmt->execute();
    }

    public function checkManager($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM user WHERE roles = :roles";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':roles', '["ROLE_MANAGER"]');
        $stmt->execute();
        if($stmt->rowCount()>0){
            return False;
        }
        else{
            return True;
        }
    }

    public function getUser($userId,$em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM user WHERE id = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('userId', $userId);
        $stmt->execute();
        return $stmt-> fetchAll()[0];
    }

    
}

