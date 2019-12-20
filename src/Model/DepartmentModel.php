<?php

namespace App\Model;

class DepartmentModel{

    public function getAllDepartments($em){
        $conn = $em->getConnection();
        $sql = "SELECT * FROM department ORDER BY dept_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addDepartment($department, $em){
        $conn = $em->getConnection();
        $sql = "INSERT INTO department(dept_id, dept_name, building, floor) VALUES (:dept_id, :dept_name, :building, :floor)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':dept_id', $department->getDeptId());
        $stmt->bindValue(':dept_name',$department->getDeptName());
        $stmt->bindValue(':building', $department->getBuilding());
        $stmt->bindValue(':floor', $department->getFloor());
        $stmt->execute();
    }

    public function changeDepartmentDetails($department, $em){
        $conn = $em->getConnection();
        $sql = "UPDATE department SET dept_id = dept_id, dept_name = :dept_name, building = :building, floor = :floor WHERE dept_id = :dept_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':dept_id', $department->getDeptId());
        $stmt->bindValue(':dept_name',$department->getDeptName());
        $stmt->bindValue(':building', $department->getBuilding());
        $stmt->bindValue(':floor', $department->getFloor());
        $stmt->execute();

    }

    public function getDepartmentName($dept_id, $em){
        $conn = $em->getConnection();
        $sql = "SELECT dept_name FROM department WHERE dept_id = :dept_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':dept_id', $dept_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteDepartment($departmentID, $em){
        $conn = $em->getConnection();
        $sql = "DELETE FROM department where department_id = :department_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':department_ID',$departmentID);
        $stmt->execute();
    }

}