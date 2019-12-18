<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leaves
 *
 * @ORM\Table(name="leaves", indexes={@ORM\Index(name="leave_type", columns={"leave_type"}), @ORM\Index(name="emp_id", columns={"emp_id"})})
 * @ORM\Entity
 */
class Leaves
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="from", type="date", nullable=true)
     */
    private $from;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="till", type="date", nullable=true)
     */
    private $till;

    /**
     * @var string|null
     *
     * @ORM\Column(name="approval_status", type="string", length=15, nullable=true)
     */
    private $approvalStatus;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="emp_id")
     * })
     */
    private $emp;

    /**
     * @var \LeaveType
     *
     * @ORM\ManyToOne(targetEntity="LeaveType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="leave_type", referencedColumnName="leave_type")
     * })
     */
    private $leaveType;

    public function getLeaveFormId(): ?int
    {
        return $this->leaveFormId;
    }

    public function getFrom(): ?\DateTimeInterface
    {
        return $this->from;
    }

    public function setFrom(?\DateTimeInterface $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTill(): ?\DateTimeInterface
    {
        return $this->till;
    }

    public function setTill(?\DateTimeInterface $till): self
    {
        $this->till = $till;

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

    public function getEmp(): ?Employee
    {
        return $this->emp;
    }

    public function setEmp(?Employee $emp): self
    {
        $this->emp = $emp;

        return $this;
    }

    public function getLeaveType(): ?LeaveType
    {
        return $this->leaveType;
    }

    public function setLeaveType(?LeaveType $leaveType): self
    {
        $this->leaveType = $leaveType;

        return $this;
    }


}
