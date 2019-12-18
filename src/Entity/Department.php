<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity
 */
class Department
{
    /**
     * @var string
     *
     * @ORM\Column(name="dept_name", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $deptName = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="building", type="string", length=20, nullable=true)
     */
    private $building;

    /**
     * @var string|null
     *
     * @ORM\Column(name="floor", type="string", length=15, nullable=true)
     */
    private $floor;

    public function getDeptName(): ?string
    {
        return $this->deptName;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }


}
