<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobTitle
 *
 * @ORM\Table(name="job_title", uniqueConstraints={@ORM\UniqueConstraint(name="job_title", columns={"job_title"})})
 * @ORM\Entity
 */
class JobTitle
{
    /**
     * @var int
     *
     * @ORM\Column(name="job_title_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jobTitleId;

    /**
     * @var string
     *
     * @ORM\Column(name="job_title", type="string", length=20, nullable=false)
     */
    private $jobTitle = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=true)
     */
    private $description;

    public function getJobTitleId(): ?int
    {
        return $this->jobTitleId;
    }

    // public function setJobTitleId(?int $jobTitleId): self
    // {
    //     $this->jobTitleId = $jobTitleId;
    //     return $this;
    // }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
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


}
