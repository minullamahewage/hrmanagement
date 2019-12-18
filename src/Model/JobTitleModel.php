<?php

namespace App\Model;

class JobTitleModel {

    public function getAllJobTitles($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM job_title";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt-> fetchAll();
    }

    public function addNewJobTitle($jobTitle, $em)
    {
        // $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        // $date=$task->getDate()->format('Y-m-d H:i:s');
        $sql = "INSERT INTO job_title (job_title,description) VALUES (:job_title,:description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':job_title', $jobTitle->getJobTitle());
        $stmt->bindValue(':description', $jobTitle->getDescription());
        $stmt->execute();
        // return $stmt-> fetchAll();
    }

    // public function changeJobTitle($jobTitle,$em){
    //     $conn= $em->getConnection();
    //     $sql="UPDATE job_title SET job_title = :job_title, description = :description WHERE "

    // }
}

