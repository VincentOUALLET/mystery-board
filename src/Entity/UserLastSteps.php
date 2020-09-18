<?php

namespace App\Entity;

use App\Repository\UserLastStepsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserLastStepsRepository::class)
 */
class UserLastSteps
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Step::class, inversedBy="userLastSteps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $last_step;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastStep(): ?Step
    {
        return $this->last_step;
    }

    public function setLastStep(?Step $last_step): self
    {
        $this->last_step = $last_step;

        return $this;
    }
}
