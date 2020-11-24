<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StoryRepository::class)
 */
class Story
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="story")
     */
    private $steps;

    /**
     * @ORM\OneToMany(targetEntity=UserLastSteps::class, mappedBy="story")
     */
    private $userLastSteps;

    /**
     * @ORM\OneToOne(targetEntity=Step::class, cascade={"persist", "remove"})
     */
    private $first_step;

    /**
     * @ORM\OneToMany(targetEntity=UserEndingStepsRecords::class, mappedBy="story")
     */
    private $userEndingStepsRecords;

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
        $this->steps = new ArrayCollection();
        $this->userLastSteps = new ArrayCollection();
        $this->userEndingStepsRecords = new ArrayCollection();
        $this->setCreatedAt(new \DateTime('now'));
        $this->setUpdatedAt(new \DateTime('now'));
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    /**
     * @return Collection|Step[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setStory($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->steps->contains($step)) {
            $this->steps->removeElement($step);
            // set the owning side to null (unless already changed)
            if ($step->getStory() === $this) {
                $step->setStory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserLastSteps[]
     */
    public function getUserLastSteps(): Collection
    {
        return $this->userLastSteps;
    }

    public function addUserLastStep(UserLastSteps $userLastStep): self
    {
        if (!$this->userLastSteps->contains($userLastStep)) {
            $this->userLastSteps[] = $userLastStep;
            $userLastStep->setStory($this);
        }

        return $this;
    }

    public function removeUserLastStep(UserLastSteps $userLastStep): self
    {
        if ($this->userLastSteps->contains($userLastStep)) {
            $this->userLastSteps->removeElement($userLastStep);
            // set the owning side to null (unless already changed)
            if ($userLastStep->getStory() === $this) {
                $userLastStep->setStory(null);
            }
        }

        return $this;
    }

    public function getFirstStep(): ?Step
    {
        return $this->first_step;
    }

    public function setFirstStep(Step $first_step): self
    {
        $this->first_step = $first_step;

        return $this;
    }

    /**
     * @return Collection|UserEndingStepsRecords[]
     */
    public function getUserEndingStepsRecords(): Collection
    {
        return $this->userEndingStepsRecords;
    }

    public function addUserEndingStepsRecord(UserEndingStepsRecords $userEndingStepsRecord): self
    {
        if (!$this->userEndingStepsRecords->contains($userEndingStepsRecord)) {
            $this->userEndingStepsRecords[] = $userEndingStepsRecord;
            $userEndingStepsRecord->setStory($this);
        }

        return $this;
    }

    public function removeUserEndingStepsRecord(UserEndingStepsRecords $userEndingStepsRecord): self
    {
        if ($this->userEndingStepsRecords->contains($userEndingStepsRecord)) {
            $this->userEndingStepsRecords->removeElement($userEndingStepsRecord);
            // set the owning side to null (unless already changed)
            if ($userEndingStepsRecord->getStory() === $this) {
                $userEndingStepsRecord->setStory(null);
            }
        }

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
