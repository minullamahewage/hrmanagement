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
     * 
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_id", type="string", length=10, nullable=false)
     * @ORM\Id
     * 
     */
    private $empId = '';

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }
    
    public function setTelephone(?string $telephone) : self
    {
        $this->telephone = $telephone;
        return $this;

    }

    public function getEmpId(): ?string
    {
        return $this->empId;
    }

    public function setEmpId(?string $empId): self
    {
        $this->empId = $empId;

        return $this;
    }


}
