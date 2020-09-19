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
    public function __toString()
    {
        return $this->getTitle();
    }
    
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

    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->userLastSteps = new ArrayCollection();
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
}
