<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmergencyContact
 *
 * @ORM\Table(name="emergency_contact", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})}, indexes={@ORM\Index(name="emp_id", columns={"emp_id"})})
 * @ORM\Entity
 */
class EmergencyContact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=12, nullable=true)
     */
    private $telephone;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="emp_id")
     * })
     */
    private $emp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
