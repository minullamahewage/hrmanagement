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
     * @ORM\Column(name="NIC", type="string", length=12, nullable=true)
     */
    private $nic;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addr_line_1", type="string", length=30, nullable=true)
     */
    private $addrLine1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addr_line_2", type="string", length=30, nullable=true)
     */
    private $addrLine2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=30, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=30, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=true)
     */
    private $postalCode;

    /**
     * @var \DateTime|null
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
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch_id", referencedColumnName="branch_id")
     * })
     */
    private $branch;

    /**
     * @var \PayGrade
     *
     * @ORM\ManyToOne(targetEntity="PayGrade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pay_grade", referencedColumnName="pay_grade")
     * })
     */
    private $payGrade;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="superviser_id", referencedColumnName="emp_id")
     * })
     */
    private $superviser;

    /**
     * @var \Department
     *
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dept_id", referencedColumnName="dept_id")
     * })
     */
    private $dept;

    /**
     * @var \EmploymentStatus
     *
     * @ORM\ManyToOne(targetEntity="EmploymentStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_status_id", referencedColumnName="id")
     * })
     */
    private $empStatus;

    /**
     * @var \JobTitle
     *
     * @ORM\ManyToOne(targetEntity="JobTitle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="job_title_id", referencedColumnName="job_title_id")
     * })
     */
    private $jobTitle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EmpCustom", inversedBy="emp")
     * @ORM\JoinTable(name="emp_custom_data",
     *   joinColumns={
     *     @ORM\JoinColumn(name="emp_id", referencedColumnName="emp_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="attribute", referencedColumnName="attribute")
     *   }
     * )
     */
    private $attribute;

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

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): self
    {
        $this->branch = $branch;

        return $this;
    }

    public function getPayGrade(): ?PayGrade
    {
        return $this->payGrade;
    }

    public function setPayGrade(?PayGrade $payGrade): self
    {
        $this->payGrade = $payGrade;

        return $this;
    }

    public function getSuperviser(): ?self
    {
        return $this->superviser;
    }

    public function setSuperviser(?self $superviser): self
    {
        $this->superviser = $superviser;

        return $this;
    }

    public function getDept(): ?Department
    {
        return $this->dept;
    }

    public function setDept(?Department $dept): self
    {
        $this->dept = $dept;

        return $this;
    }

    public function getEmpStatus(): ?EmploymentStatus
    {
        return $this->empStatus;
    }

    public function setEmpStatus(?EmploymentStatus $empStatus): self
    {
        $this->empStatus = $empStatus;

        return $this;
    }

    public function getJobTitle(): ?JobTitle
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?JobTitle $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return Collection|EmpCustom[]
     */
    public function getAttribute(): Collection
    {
        return $this->attribute;
    }

    public function addAttribute(EmpCustom $attribute): self
    {
        if (!$this->attribute->contains($attribute)) {
            $this->attribute[] = $attribute;
        }

        return $this;
    }

    public function removeAttribute(EmpCustom $attribute): self
    {
        if ($this->attribute->contains($attribute)) {
            $this->attribute->removeElement($attribute);
        }

        return $this;
    }

}
