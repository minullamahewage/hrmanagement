<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmploymentStatus
 *
 * @ORM\Table(name="employment_status", uniqueConstraints={@ORM\UniqueConstraint(name="emp_status", columns={"emp_status"})})
 * @ORM\Entity
 */
class EmploymentStatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_status", type="string", length=20, nullable=false)
     */
    private $empStatus = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmpStatus(): ?string
    {
        return $this->empStatus;
    }

    public function setEmpStatus(string $empStatus): self
    {
        $this->empStatus = $empStatus;

        return $this;
    }


}
