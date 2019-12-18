<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LeaveType
 *
 * @ORM\Table(name="leave_type")
 * @ORM\Entity
 */
class LeaveType
{
    /**
     * @var string
     *
     * @ORM\Column(name="leave_type", type="string", length=15, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $leaveType = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PayGrade", mappedBy="leaveType")
     */
    private $payGrade;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->payGrade = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getLeaveType(): ?string
    {
        return $this->leaveType;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|PayGrade[]
     */
    public function getPayGrade(): Collection
    {
        return $this->payGrade;
    }

    public function addPayGrade(PayGrade $payGrade): self
    {
        if (!$this->payGrade->contains($payGrade)) {
            $this->payGrade[] = $payGrade;
            $payGrade->addLeaveType($this);
        }

        return $this;
    }

    public function removePayGrade(PayGrade $payGrade): self
    {
        if ($this->payGrade->contains($payGrade)) {
            $this->payGrade->removeElement($payGrade);
            $payGrade->removeLeaveType($this);
        }

        return $this;
    }

}
