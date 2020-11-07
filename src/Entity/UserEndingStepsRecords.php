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

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updated_at;

    public function __construct(){
        $this->setCreatedAt(new \DateTime('now'));
        $this->setUpdatedAt(new \DateTime('now'));
    }

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
