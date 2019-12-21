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
     * @var string|null
     *
      * @ORM\Column(name="emp_id", type="string", length=10, nullable=false)
     */
    private $emp_id;

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
