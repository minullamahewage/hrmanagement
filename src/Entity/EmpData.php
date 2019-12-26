<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmpData
 *
 * @ORM\Table(name="emp_data", indexes={@ORM\index(name="attribute", columns={"attribute"})})
 * @ORM\Entity
 */
class EmpData
{
    /**
     * @var string
     *
     * @ORM\Column(name="attribute", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $attribute;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_id", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $emp_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=50, nullable=true)
     */
    private $value;


    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;
        return $this;
        
    }

    public function getEmpId(): ?string
    {
        return $this->emp_id;
    }

    public function setEmpId(string $emp_id): self
    {
        $this->emp_id = $emp_id;
        return $this;
        
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;
        return $this;
        
    }

    

}
