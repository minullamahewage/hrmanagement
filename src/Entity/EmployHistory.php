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
     * @ORM\Column(name="to_date", type="datetime", nullable=true)
     */
    private $toDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="from_date", type="datetime", nullable=true)
     */
    private $fromDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emp_status", type="string", length=20, nullable=true)
     */
    private $empStatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emp_id", type="string", length=10, nullable=false)
     *
     */
    private $emp_id;

    public function getEmpHistoryId(): ?int
    {
        return $this->empHistoryId;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(?\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
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

    public function getEmpStatus(): ?string
    {
        return $this->empStatus;
    }

    public function setEmpStatus(?string $empStatus): self
    {
        $this->empStatus = $empStatus;

        return $this;
    }

    public function getEmpId(): ?string
    {
        return $this->emp_id;
    }

    public function setEmpId(?string $emp_id): self
    {
        $this->emp_id = $emp_id;

        return $this;
    }


}
