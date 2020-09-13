<?php

namespace App\Entity;

use App\Repository\StepRepository;
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $choice1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $choice2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $choice3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $choice4;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $choice5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChoice1(): ?int
    {
        return $this->choice1;
    }

    public function setChoice1(?int $choice1): self
    {
        $this->choice1 = $choice1;

        return $this;
    }

    public function getChoice2(): ?int
    {
        return $this->choice2;
    }

    public function setChoice2(?int $choice2): self
    {
        $this->choice2 = $choice2;

        return $this;
    }

    public function getChoice3(): ?int
    {
        return $this->choice3;
    }

    public function setChoice3(?int $choice3): self
    {
        $this->choice3 = $choice3;

        return $this;
    }

    public function getChoice4(): ?int
    {
        return $this->choice4;
    }

    public function setChoice4(?int $choice4): self
    {
        $this->choice4 = $choice4;

        return $this;
    }

    public function getChoice5(): ?int
    {
        return $this->choice5;
    }

    public function setChoice5(?int $choice5): self
    {
        $this->choice5 = $choice5;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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
}
