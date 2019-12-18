<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PayGrade
 *
 * @ORM\Table(name="pay_grade")
 * @ORM\Entity
 */
class PayGrade
{
    /**
     * @var string
     *
     * @ORM\Column(name="pay_grade", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $payGrade;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="LeaveType", inversedBy="payGrade")
     * @ORM\JoinTable(name="leave_limit",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pay_grade", referencedColumnName="pay_grade")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="leave_type", referencedColumnName="leave_type")
     *   }
     * )
     */
    private $leaveType;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->leaveType = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getPayGrade(): ?string
    {
        return $this->payGrade;
    }

    /**
     * @return Collection|LeaveType[]
     */
    public function getLeaveType(): Collection
    {
        return $this->leaveType;
    }

    public function addLeaveType(LeaveType $leaveType): self
    {
        if (!$this->leaveType->contains($leaveType)) {
            $this->leaveType[] = $leaveType;
        }

        return $this;
    }

    public function removeLeaveType(LeaveType $leaveType): self
    {
        if ($this->leaveType->contains($leaveType)) {
            $this->leaveType->removeElement($leaveType);
        }

        return $this;
    }

}
