<?php

namespace App\Model;

class JobTitleModel {

    public function getAllJobTitles($em){

        $conn = $em->getConnection();
        $sql = "SELECT * FROM job_title ORDER BY job_title ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt-> fetchAll();
    }

    public function addJobTitle($jobTitle, $em)
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

    public function changeJobTitle($jobTitle,$em){
        $conn= $em->getConnection();
        $sql="UPDATE job_title SET job_title = :job_title, description = :description WHERE job_title_id= :job_title_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':job_title', $jobTitle->getJobTitle());
        $stmt->bindValue(':description', $jobTitle->getDescription());
        $stmt->bindValue(':job_title_id', $jobTitle->getJobTitleId());
        $stmt->execute();

    }

    public function getJobTitle($jobTitleId, $em){
        $conn = $em->getConnection();
        $sql = "SELECT job_title from job_title WHERE job_title_id = :job_title_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':job_title_id' , $jobTitleId);
        $stmt->execute();
        return $stmt->fetchAll()[0]['job_title'];

    }
    public function getJobTitleId($jobTitle, $em){
        $conn = $em->getConnection();
        $sql = "SELECT job_title_id from job_title WHERE job_title = :job_title";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':job_title' , $jobTitle);
        $stmt->execute();
        return $stmt->fetchAll()[0]['job_title_id'];

    }
}

