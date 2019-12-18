<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmpCustom
 *
 * @ORM\Table(name="emp_custom", uniqueConstraints={@ORM\UniqueConstraint(name="attribute", columns={"attribute"})})
 * @ORM\Entity
 */
class EmpCustom
{
    /**
     * @var string
     *
     * @ORM\Column(name="attribute", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $attribute;


    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    
    public function setAttribute(string $string): self
    {
        $this->attribute = $attribute;
        return $this;
        
    }

}
