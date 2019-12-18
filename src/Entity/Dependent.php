<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dependent
 *
 * @ORM\Table(name="dependent", indexes={@ORM\Index(name="emp_id", columns={"emp_id"})})
 * @ORM\Entity
 */
class Dependent
{
    /**
     * @var int
     *
     * @ORM\Column(name="dependent_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dependentId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nic", type="string", length=12, nullable=true)
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
     * @ORM\Column(name="relationship", type="string", length=20, nullable=true)
     */
    private $relationship;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=12, nullable=true)
     */
    private $telephone;

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
     * @ORM\Column(name="city", type="string", length=20, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=20, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=true)
     */
    private $postalCode;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="emp_id")
     * })
     */
    private $emp;

    public function getDependentId(): ?int
    {
        return $this->dependentId;
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

    public function getRelationship(): ?string
    {
        return $this->relationship;
    }

    public function setRelationship(?string $relationship): self
    {
        $this->relationship = $relationship;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

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
