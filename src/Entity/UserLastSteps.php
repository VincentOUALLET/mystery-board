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
     */
    private $last_step;

    /**
     * @ORM\ManyToOne(targetEntity=Story::class, inversedBy="userLastSteps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $story;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userLastSteps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $restart_number;

    public function __construct()
    {
        $this->setRestartNumber(0);
    }

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

    public function getStory(): ?Story
    {
        return $this->story;
    }

    public function setStory(?Story $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRestartNumber(): ?int
    {
        return $this->restart_number;
    }

    public function setRestartNumber(?int $restart_number): self
    {
        $this->restart_number = $restart_number;

        return $this;
    }
}
