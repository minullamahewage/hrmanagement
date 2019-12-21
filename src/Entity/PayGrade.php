<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PayGrade
 *
 * @ORM\Table(name="pay_grade")
 * @ORM\Entity
 */
class PayGrade
{
    /**
     * @var string
     *
     * @ORM\Column(name="pay_grade", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $payGrade;

    /**
     * Constructor
     */
    public function __construct()
    {
        
    }

    public function getPayGrade(): ?string
    {
        return $this->payGrade;
    }
    public function setPayGrade(string $payGrade): self
    {
        $this->payGrade = $payGrade;

        return $this;
    }

    

}
