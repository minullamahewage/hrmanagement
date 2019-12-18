<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployHistory
 *
 * @ORM\Table(name="employ_history", indexes={@ORM\Index(name="emp_id", columns={"emp_id"})})
 * @ORM\Entity
 */
class EmployHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="emp_history_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $empHistoryId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="to", type="date", nullable=true)
     */
    private $to;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="from", type="date", nullable=true)
     */
    private $from;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emp_status", type="string", length=20, nullable=true)
     */
    private $empStatus;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="emp_id")
     * })
     */
    private $emp;

    public function getEmpHistoryId(): ?int
    {
        return $this->empHistoryId;
    }

    public function getTo(): ?\DateTimeInterface
    {
        return $this->to;
    }

    public function setTo(?\DateTimeInterface $to): self
    {
        $this->to = $to;

        return $this;
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

    public function getEmpStatus(): ?string
    {
        return $this->empStatus;
    }

    public function setEmpStatus(?string $empStatus): self
    {
        $this->empStatus = $empStatus;

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


}
