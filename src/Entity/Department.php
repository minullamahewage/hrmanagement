<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department", uniqueConstraints={@ORM\UniqueConstraint(name="dept_name", columns={"dept_name"})})
 * @ORM\Entity
 */
class Department
{
    /**
     * @var int
     *
     * @ORM\Column(name="dept_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $deptId;

    /**
     * @var string
     *
     * @ORM\Column(name="dept_name", type="string", length=20, nullable=false)
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

    public function getDeptId(): ?int
    {
        return $this->deptId;
    }

    public function setDeptId(string $deptId): self
    {
        $this->deptId = $deptId;

        return $this;
    }

    public function getDeptName(): ?string
    {
        return $this->deptName;
    }

    public function setDeptName(?string $deptName): self
    {
        $this->deptName = $deptName;

        return $this;
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
