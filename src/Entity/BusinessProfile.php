<?php

namespace App\Entity;

use App\Repository\BusinessProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessProfileRepository::class)
 */
class BusinessProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $industry;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $targetAudience;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $toneOfVoice;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentPreferences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoUrl;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="businessProfiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=SocialAccount::class, mappedBy="businessProfile", orphanRemoval=true)
     */
    private $socialAccounts;

    /**
     * @ORM\OneToMany(targetEntity=ContentTopic::class, mappedBy="businessProfile", orphanRemoval=true)
     */
    private $contentTopics;

    /**
     * @ORM\OneToMany(targetEntity=ContentItem::class, mappedBy="businessProfile", orphanRemoval=true)
     */
    private $contentItems;

    /**
     * @ORM\OneToMany(targetEntity=ContentCalendar::class, mappedBy="businessProfile", orphanRemoval=true)
     */
    private $contentCalendars;

    public function __construct()
    {
        $this->socialAccounts = new ArrayCollection();
        $this->contentTopics = new ArrayCollection();
        $this->contentItems = new ArrayCollection();
        $this->contentCalendars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIndustry(): ?string
    {
        return $this->industry;
    }

    public function setIndustry(?string $industry): self
    {
        $this->industry = $industry;

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

    public function getTargetAudience(): ?string
    {
        return $this->targetAudience;
    }

    public function setTargetAudience(?string $targetAudience): self
    {
        $this->targetAudience = $targetAudience;

        return $this;
    }

    public function getToneOfVoice(): ?string
    {
        return $this->toneOfVoice;
    }

    public function setToneOfVoice(?string $toneOfVoice): self
    {
        $this->toneOfVoice = $toneOfVoice;

        return $this;
    }

    public function getContentPreferences(): ?string
    {
        return $this->contentPreferences;
    }

    public function setContentPreferences(?string $contentPreferences): self
    {
        $this->contentPreferences = $contentPreferences;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, SocialAccount>
     */
    public function getSocialAccounts(): Collection
    {
        return $this->socialAccounts;
    }

    public function addSocialAccount(SocialAccount $socialAccount): self
    {
        if (!$this->socialAccounts->contains($socialAccount)) {
            $this->socialAccounts[] = $socialAccount;
            $socialAccount->setBusinessProfile($this);
        }

        return $this;
    }

    public function removeSocialAccount(SocialAccount $socialAccount): self
    {
        if ($this->socialAccounts->removeElement($socialAccount)) {
            // set the owning side to null (unless already changed)
            if ($socialAccount->getBusinessProfile() === $this) {
                $socialAccount->setBusinessProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ContentTopic>
     */
    public function getContentTopics(): Collection
    {
        return $this->contentTopics;
    }

    public function addContentTopic(ContentTopic $contentTopic): self
    {
        if (!$this->contentTopics->contains($contentTopic)) {
            $this->contentTopics[] = $contentTopic;
            $contentTopic->setBusinessProfile($this);
        }

        return $this;
    }

    public function removeContentTopic(ContentTopic $contentTopic): self
    {
        if ($this->contentTopics->removeElement($contentTopic)) {
            // set the owning side to null (unless already changed)
            if ($contentTopic->getBusinessProfile() === $this) {
                $contentTopic->setBusinessProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ContentItem>
     */
    public function getContentItems(): Collection
    {
        return $this->contentItems;
    }

    public function addContentItem(ContentItem $contentItem): self
    {
        if (!$this->contentItems->contains($contentItem)) {
            $this->contentItems[] = $contentItem;
            $contentItem->setBusinessProfile($this);
        }

        return $this;
    }

    public function removeContentItem(ContentItem $contentItem): self
    {
        if ($this->contentItems->removeElement($contentItem)) {
            // set the owning side to null (unless already changed)
            if ($contentItem->getBusinessProfile() === $this) {
                $contentItem->setBusinessProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ContentCalendar>
     */
    public function getContentCalendars(): Collection
    {
        return $this->contentCalendars;
    }

    public function addContentCalendar(ContentCalendar $contentCalendar): self
    {
        if (!$this->contentCalendars->contains($contentCalendar)) {
            $this->contentCalendars[] = $contentCalendar;
            $contentCalendar->setBusinessProfile($this);
        }

        return $this;
    }

    public function removeContentCalendar(ContentCalendar $contentCalendar): self
    {
        if ($this->contentCalendars->removeElement($contentCalendar)) {
            // set the owning side to null (unless already changed)
            if ($contentCalendar->getBusinessProfile() === $this) {
                $contentCalendar->setBusinessProfile(null);
            }
        }

        return $this;
    }
}
