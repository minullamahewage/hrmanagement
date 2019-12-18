<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmploymentStatus
 *
 * @ORM\Table(name="employment_status")
 * @ORM\Entity
 */
class EmploymentStatus
{
    /**
     * @var string
     *
     * @ORM\Column(name="emp_status", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $empStatus = '';

    public function getEmpStatus(): ?string
    {
        return $this->empStatus;
    }


}
