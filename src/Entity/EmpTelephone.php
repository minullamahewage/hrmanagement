<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmpTelephone
 *
 * @ORM\Table(name="emp_telephone", indexes={@ORM\Index(name="IDX_BF6E29A17A663008", columns={"emp_id"})})
 * @ORM\Entity
 */
class EmpTelephone
{
    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=12, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $telephone = '';

    /**
     * @var \Employee
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_id", referencedColumnName="emp_id")
     * })
     */
    private $emp;

    public function getTelephone(): ?string
    {
        return $this->telephone;
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
