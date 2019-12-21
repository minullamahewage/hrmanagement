<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LeaveType
 *
 * @ORM\Table(name="leave_limit")
 * @ORM\Entity
 */
class LeaveLimit
{
    /**
     * @var string
     *
     * @ORM\Column(name="leave_type", type="string", length=15, nullable=false)
     * @ORM\Id
     * 
     */
    private $leaveType = '';
    /**
     * @var string
     *
     * @ORM\Column(name="pay_grade", type="string", length=10, nullable=false)
     * @ORM\Id
     * 
     */
    private $payGrade = '';

    /**
     * @var integer|null
     *
     * @ORM\Column(name="leave_limit", type="integer",  nullable=false)
     */
    private $leaveLimit;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function getLeaveType(): ?string
    {
        return $this->leaveType;
    }

    public function setLeaveType(?string $leaveType): self
    {
        $this->leaveType = $leaveType;
    }

    public function getPayGrade(): ?string
    {
        return $this->payGrade;
    }

    public function setPayGrade(?string $payGrade): self
    {
        $this->payGrade = $payGrade;

        return $this;
    }

    public function getLeaveLimit(): ?int
    {
        return $this->leaveLimit;
    }

    public function setLeaveLimit(?int $leaveLimit): self
    {
        $this->leaveLimit = $leaveLimit;

        return $this;
    }


}
