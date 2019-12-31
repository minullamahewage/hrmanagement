<?php

namespace App\Model;

class UserModel {

    public function getAllUsers($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM user ORDER BY type ASC";
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

    // public function changeJobTitle($jobTitle,$em){
    //     $conn= $em->getConnection();
    //     $sql="UPDATE job_title SET job_title = :job_title, description = :description WHERE job_title_id= :job_title_id";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindValue(':job_title', $jobTitle->getJobTitle());
    //     $stmt->bindValue(':description', $jobTitle->getDescription());
    //     $stmt->bindValue(':job_title_id', $jobTitle->getJobTitleId());
    //     $stmt->execute();

    // }

    // public function getJobTitle($jobTitleId, $em){
    //     $conn = $em->getConnection();
    //     $sql = "SELECT job_title from job_title WHERE job_title_id = :job_title_id";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindValue(':job_title_id' , $jobTitleId);
    //     $stmt->execute();
    //     return $stmt->fetchAll()[0]['job_title'];

    // }
    // public function getJobTitleId($jobTitle, $em){
    //     $conn = $em->getConnection();
    //     $sql = "SELECT job_title_id from job_title WHERE job_title = :job_title";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindValue(':job_title' , $jobTitle);
    //     $stmt->execute();
    //     return $stmt->fetchAll()[0]['job_title_id'];

    // }

    public function deleteUser($user, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM user WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username' , $user->getUsername());
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

    
}

