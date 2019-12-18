<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobTitle
 *
 * @ORM\Table(name="job_title")
 * @ORM\Entity
 */
class JobTitle
{
    /**
     * @var string
     *
     * @ORM\Column(name="job_title", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jobTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=true)
     */
    private $description;


    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }


}
