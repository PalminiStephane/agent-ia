<?php

namespace App\Entity;

use App\Repository\SocialAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocialAccountRepository::class)
 */
class SocialAccount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $platform;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $accountIdentifier;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accessToken;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $refreshToken;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tokenExpiresAt;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessProfile::class, inversedBy="socialAccounts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $businessProfile;

    /**
     * @ORM\OneToMany(targetEntity=ScheduledPost::class, mappedBy="socialAccount", orphanRemoval=true)
     */
    private $scheduledPosts;

    public function __construct()
    {
        $this->scheduledPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getAccountIdentifier(): ?string
    {
        return $this->accountIdentifier;
    }

    public function setAccountIdentifier(string $accountIdentifier): self
    {
        $this->accountIdentifier = $accountIdentifier;

        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(?string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(?string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getTokenExpiresAt(): ?\DateTimeInterface
    {
        return $this->tokenExpiresAt;
    }

    public function setTokenExpiresAt(?\DateTimeInterface $tokenExpiresAt): self
    {
        $this->tokenExpiresAt = $tokenExpiresAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBusinessProfile(): ?BusinessProfile
    {
        return $this->businessProfile;
    }

    public function setBusinessProfile(?BusinessProfile $businessProfile): self
    {
        $this->businessProfile = $businessProfile;

        return $this;
    }

    /**
     * @return Collection<int, ScheduledPost>
     */
    public function getScheduledPosts(): Collection
    {
        return $this->scheduledPosts;
    }

    public function addScheduledPost(ScheduledPost $scheduledPost): self
    {
        if (!$this->scheduledPosts->contains($scheduledPost)) {
            $this->scheduledPosts[] = $scheduledPost;
            $scheduledPost->setSocialAccount($this);
        }

        return $this;
    }

    public function removeScheduledPost(ScheduledPost $scheduledPost): self
    {
        if ($this->scheduledPosts->removeElement($scheduledPost)) {
            // set the owning side to null (unless already changed)
            if ($scheduledPost->getSocialAccount() === $this) {
                $scheduledPost->setSocialAccount(null);
            }
        }

        return $this;
    }
}
