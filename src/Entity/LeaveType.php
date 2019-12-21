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

    public function setLeaveType(?string $leaveType): self
    {
        $this->leaveType = $leaveType;
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


}
