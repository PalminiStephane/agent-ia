<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
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
     * @ORM\OneToMany(targetEntity=BusinessProfile::class, mappedBy="user", orphanRemoval=true)
     */
    private $businessProfiles;

    /**
     * @ORM\OneToMany(targetEntity=OpenaiApiLog::class, mappedBy="user")
     */
    private $openaiApiLogs;

    public function __construct()
    {
        $this->businessProfiles = new ArrayCollection();
        $this->openaiApiLogs = new ArrayCollection();
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
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
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
     * @return Collection<int, BusinessProfile>
     */
    public function getBusinessProfiles(): Collection
    {
        return $this->businessProfiles;
    }

    public function addBusinessProfile(BusinessProfile $businessProfile): self
    {
        if (!$this->businessProfiles->contains($businessProfile)) {
            $this->businessProfiles[] = $businessProfile;
            $businessProfile->setUser($this);
        }

        return $this;
    }

    public function removeBusinessProfile(BusinessProfile $businessProfile): self
    {
        if ($this->businessProfiles->removeElement($businessProfile)) {
            // set the owning side to null (unless already changed)
            if ($businessProfile->getUser() === $this) {
                $businessProfile->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OpenaiApiLog>
     */
    public function getOpenaiApiLogs(): Collection
    {
        return $this->openaiApiLogs;
    }

    public function addOpenaiApiLog(OpenaiApiLog $openaiApiLog): self
    {
        if (!$this->openaiApiLogs->contains($openaiApiLog)) {
            $this->openaiApiLogs[] = $openaiApiLog;
            $openaiApiLog->setUser($this);
        }

        return $this;
    }

    public function removeOpenaiApiLog(OpenaiApiLog $openaiApiLog): self
    {
        if ($this->openaiApiLogs->removeElement($openaiApiLog)) {
            // set the owning side to null (unless already changed)
            if ($openaiApiLog->getUser() === $this) {
                $openaiApiLog->setUser(null);
            }
        }

        return $this;
    }
}
