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

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updated_at;

    public function __construct()
    {
        $this->setRestartNumber(0);
        $this->setCreatedAt(new \DateTime('now'));
        $this->setUpdatedAt(new \DateTime('now'));
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
