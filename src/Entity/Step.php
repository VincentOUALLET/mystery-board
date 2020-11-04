<?php

namespace App\Entity;

use App\Repository\StepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StepRepository::class)
 * @Vich\Uploadable
 */
class Step
{
    public function __toString()
    {
        return $this->getStory() . " - " . $this->getCustomId();
    }
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

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featured_image;

    /**
     * 
     * @Assert\File(
     *     maxSize = "10Mi",
     * )
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity=UserEndingStepsRecords::class, mappedBy="step")
     */
    private $userEndingStepsRecords;

    public function __construct()
    {
        $this->userLastSteps = new ArrayCollection();
        $this->userEndingStepsRecords = new ArrayCollection();
        $this->setUpdatedAt(new \DateTime('now'));
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    public function setFeaturedImage($featured_image)
    {
        $this->featured_image = $featured_image;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updated_at = new \DateTime('now');
        }
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
            $userEndingStepsRecord->setStep($this);
        }

        return $this;
    }

    public function removeUserEndingStepsRecord(UserEndingStepsRecords $userEndingStepsRecord): self
    {
        if ($this->userEndingStepsRecords->contains($userEndingStepsRecord)) {
            $this->userEndingStepsRecords->removeElement($userEndingStepsRecord);
            // set the owning side to null (unless already changed)
            if ($userEndingStepsRecord->getStep() === $this) {
                $userEndingStepsRecord->setStep(null);
            }
        }

        return $this;
    }
}
