<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il y a déjà un compte avec cette adresse mail, vous pouvez vous connecter")
 */
class User implements UserInterface
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=UserLastSteps::class, mappedBy="user")
     */
    private $userLastSteps;

    /**
     * @ORM\OneToMany(targetEntity=UserEndingStepsRecords::class, mappedBy="user")
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
        $this->userLastSteps = new ArrayCollection();
        $this->setRoles([
            "ROLE_USER"
        ]);
        $this->setCreatedAt(new \DateTime('now'));
        $this->setUpdatedAt(new \DateTime('now'));
        $this->userEndingStepsRecords = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getEmail();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $userLastStep->setUser($this);
        }

        return $this;
    }

    public function removeUserLastStep(UserLastSteps $userLastStep): self
    {
        if ($this->userLastSteps->contains($userLastStep)) {
            $this->userLastSteps->removeElement($userLastStep);
            // set the owning side to null (unless already changed)
            if ($userLastStep->getUser() === $this) {
                $userLastStep->setUser(null);
            }
        }

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
            $userEndingStepsRecord->setUser($this);
        }

        return $this;
    }

    public function removeUserEndingStepsRecord(UserEndingStepsRecords $userEndingStepsRecord): self
    {
        if ($this->userEndingStepsRecords->contains($userEndingStepsRecord)) {
            $this->userEndingStepsRecords->removeElement($userEndingStepsRecord);
            // set the owning side to null (unless already changed)
            if ($userEndingStepsRecord->getUser() === $this) {
                $userEndingStepsRecord->setUser(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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
}
