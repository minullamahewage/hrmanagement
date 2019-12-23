<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="emp_id", columns={"emp_id"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $username = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_id", type="string", length=10, nullable=false)
     */
    private $empId;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
