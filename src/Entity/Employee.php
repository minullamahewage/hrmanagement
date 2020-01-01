<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee", indexes={@ORM\Index(name="employee_ibfk_9", columns={"job_title_id"}), @ORM\Index(name="pay_grade", columns={"pay_grade"}), @ORM\Index(name="dept_id", columns={"dept_id"}), @ORM\Index(name="employee_ibfk_8", columns={"emp_status_id"}), @ORM\Index(name="branch_id", columns={"branch_id"}), @ORM\Index(name="superviser_id", columns={"superviser_id"})})
 * @ORM\Entity
 */
class Employee
{
    /**
     * @var string
     *
     * @ORM\Column(name="emp_id", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $empId = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NIC", type="string", length=12, nullable=flase)
     */
    private $nic;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addr_line_1", type="string", length=30, nullable=false)
     */
    private $addrLine1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addr_line_2", type="string", length=30, nullable=false)
     */
    private $addrLine2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=30, nullable=false)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=30, nullable=false)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=false)
     */
    private $postalCode;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="dob", type="date", nullable=true)
     */
    private $dob;

    /**
     * @var string|null
     *
     * @ORM\Column(name="marital_status", type="string", length=10, nullable=true)
     */
    private $maritalStatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="branch_id", type="string", length=10, nullable=true)
     */
    private $branchId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pay_grade", type="string", length=10, nullable=true)
     */
    private $payGrade;

    /**
     * @var string|null
     *
     * @ORM\Column(name="supervisor_id", type="string", length=10, nullable=true)
     */
    private $supervisorId;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="dept_id", type="integer", nullable=true)
     */
    private $deptId;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="emp_status_id", type="integer", nullable=true)
     */
    private $empStatusId;
     /**
     * @var string|null
     *
     * 
     */
    private $empStatus;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="job_title_id", type="integer",  nullable=true)
     */
    private $jobTitleId;
    /**
     * @var string|null
     *
     * 
     */
    private $jobTitle;

    private $cusAttr;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attribute = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getEmpId(): ?string
    {
        return $this->empId;
    }

    public function setEmpId(?string $empId): ?self
    {
        $this->empId = $empId;
        return $this;

    }

    public function getNic(): ?string
    {
        return $this->nic;
    }

    public function setNic(?string $nic): self
    {
        $this->nic = $nic;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddrLine1(): ?string
    {
        return $this->addrLine1;
    }

    public function setAddrLine1(?string $addrLine1): self
    {
        $this->addrLine1 = $addrLine1;

        return $this;
    }

    public function getAddrLine2(): ?string
    {
        return $this->addrLine2;
    }

    public function setAddrLine2(?string $addrLine2): self
    {
        $this->addrLine2 = $addrLine2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(?string $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getBranchId(): ?string
    {
        return $this->branchId;
    }

    public function setBranchId(?string $branchId): self
    {
        $this->branchId = $branchId;

        return $this;
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

    public function getSupervisorId(): ?string
    {
        return $this->supervisorId;
    }

    public function setSupervisorId(?string $supervisorId): self
    {
        $this->supervisorId = $supervisorId;

        return $this;
    }

    public function getDeptId(): ?int
    {
        return $this->deptId;
    }

    public function setDeptId(?int $deptId): self
    {
        $this->deptId = $deptId;

        return $this;
    }

    public function getEmpStatusId(): ?int
    {
        return $this->empStatusId;
    }

    public function setEmpStatusId(?int $empStatusId): self
    {
        $this->empStatusId = $empStatusId;

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

    public function getJobTitleId(): ?int
    {
        return $this->jobTitleId;
    }

    public function setJobTitleId(?int $jobTitleId): self
    {
        $this->jobTitleId = $jobTitleId;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getCusAtrr(){
        return $this->cusAttr;
    }

    public function setCusAttr($cusAttr){
        $this->cusAttr = $cusAttr;
    }

    // /**
    //  * @return Collection|EmpCustom[]
    //  */
    // public function getAttribute(): Collection
    // {
    //     return $this->attribute;
    // }

    // public function addAttribute(EmpCustom $attribute): self
    // {
    //     if (!$this->attribute->contains($attribute)) {
    //         $this->attribute[] = $attribute;
    //     }

    //     return $this;
    // }

    // public function removeAttribute(EmpCustom $attribute): self
    // {
    //     if ($this->attribute->contains($attribute)) {
    //         $this->attribute->removeElement($attribute);
    //     }

    //     return $this;
    // }

}
