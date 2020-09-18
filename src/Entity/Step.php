<?php

namespace App\Entity;

use App\Repository\StepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StepRepository::class)
 */
class Step
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Story::class, inversedBy="steps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $story;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $label_choice_1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $label_choice_2;

    /**
     * @ORM\OneToMany(targetEntity=UserLastSteps::class, mappedBy="last_step")
     */
    private $userLastSteps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $custom_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choice_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choice_2;

    public function __construct()
    {
        $this->userLastSteps = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getLabelChoice1(): ?string
    {
        return $this->label_choice_1;
    }

    public function setLabelChoice1(string $label_choice_1): self
    {
        $this->label_choice_1 = $label_choice_1;

        return $this;
    }

    public function getLabelChoice2(): ?string
    {
        return $this->label_choice_2;
    }

    public function setLabelChoice2(string $label_choice_2): self
    {
        $this->label_choice_2 = $label_choice_2;

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
            $userLastStep->setLastStep($this);
        }

        return $this;
    }

    public function removeUserLastStep(UserLastSteps $userLastStep): self
    {
        if ($this->userLastSteps->contains($userLastStep)) {
            $this->userLastSteps->removeElement($userLastStep);
            // set the owning side to null (unless already changed)
            if ($userLastStep->getLastStep() === $this) {
                $userLastStep->setLastStep(null);
            }
        }

        return $this;
    }

    public function getCustomId(): ?string
    {
        return $this->custom_id;
    }

    public function setCustomId(string $custom_id): self
    {
        $this->custom_id = $custom_id;

        return $this;
    }

    public function getChoice1(): ?string
    {
        return $this->choice_1;
    }

    public function setChoice1(?string $choice_1): self
    {
        $this->choice_1 = $choice_1;

        return $this;
    }

    public function getChoice2(): ?string
    {
        return $this->choice_2;
    }

    public function setChoice2(?string $choice_2): self
    {
        $this->choice_2 = $choice_2;

        return $this;
    }
}
