<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leaves
 *
 * @ORM\Table(name="leaves", indexes={@ORM\Index(name="leave_type", columns={"leave_type"}), @ORM\Index(name="emp_id", columns={"emp_id"})})
 * @ORM\Entity
 */
class Leave
{
    /**
     * @var int
     *
     * @ORM\Column(name="leave_form_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $leaveFormId;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="from_date", type="date", nullable=false)
     */
    private $fromDate;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="till_date", type="date", nullable=false)
     */
    private $tillDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="approval_status", type="string", length=15, nullable=false)
     */
    private $approvalStatus;

    /**
     * @var string|null
     *
     * 
     * @ORM\Column(name="emp_id", type="string", length=10, nullable=false)
     */
    private $empId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="leave_type", type="string", length=15, nullable=false)
     * 
     */
    private $leaveType;

    public function getLeaveFormId(): ?int
    {
        return $this->leaveFormId;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(?\DateTimeInterface $fromDate): self
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    public function getTillDate(): ?\DateTimeInterface
    {
        return $this->tillDate;
    }

    public function setTillDate(?\DateTimeInterface $tillDate): self
    {
        $this->tillDate = $tillDate;

        return $this;
    }

    public function getApprovalStatus(): ?string
    {
        return $this->approvalStatus;
    }

    public function setApprovalStatus(?string $approvalStatus): self
    {
        $this->approvalStatus = $approvalStatus;

        return $this;
    }

    public function getEmpId(): ?string
    {
        return $this->empId;
    }

    public function setEmpId(?string $empId): self
    {
        $this->empId = $empId;

        return $this;
    }

    public function getLeaveType(): ?string
    {
        return $this->leaveType;
    }

    public function setLeaveType(?string $leaveType): self
    {
        $this->leaveType = $leaveType;

        return $this;
    }


}
