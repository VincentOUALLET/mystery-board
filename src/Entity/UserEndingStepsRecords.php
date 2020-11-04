<?php

namespace App\Entity;

use App\Repository\UserEndingStepsRecordsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserEndingStepsRecordsRepository::class)
 */
class UserEndingStepsRecords
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Story::class, inversedBy="userEndingStepsRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $story;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userEndingStepsRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Step::class, inversedBy="userEndingStepsRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $step;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStep(): ?Step
    {
        return $this->step;
    }

    public function setStep(?Step $step): self
    {
        $this->step = $step;

        return $this;
    }
}
