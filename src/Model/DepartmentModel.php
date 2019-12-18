<?php

namespace App\Model;

class DepartmentModel{

    public function getAllDepartments($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM department ORDER BY dept_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

}