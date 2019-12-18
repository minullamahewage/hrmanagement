<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmpCustom
 *
 * @ORM\Table(name="emp_custom")
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Employee", mappedBy="attribute")
     */
    private $emp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emp = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    /**
     * @return Collection|Employee[]
     */
    public function getEmp(): Collection
    {
        return $this->emp;
    }

    public function addEmp(Employee $emp): self
    {
        if (!$this->emp->contains($emp)) {
            $this->emp[] = $emp;
            $emp->addAttribute($this);
        }

        return $this;
    }

    public function removeEmp(Employee $emp): self
    {
        if ($this->emp->contains($emp)) {
            $this->emp->removeElement($emp);
            $emp->removeAttribute($this);
        }

        return $this;
    }

}
