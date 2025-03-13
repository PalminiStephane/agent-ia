<?php

namespace App\Entity;

use App\Repository\ContentItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentItemRepository::class)
 */
class ContentItem
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
    private $contentText;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $mediaUrls = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $hashtags;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aiPrompt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $generatedAt;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $metadata = [];

    /**
     * @ORM\ManyToOne(targetEntity=BusinessProfile::class, inversedBy="contentItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $businessProfile;

    /**
     * @ORM\OneToMany(targetEntity=ContentCalendar::class, mappedBy="contentItem")
     */
    private $contentCalendars;

    /**
     * @ORM\OneToMany(targetEntity=ScheduledPost::class, mappedBy="contentItem", orphanRemoval=true)
     */
    private $scheduledPosts;

    public function __construct()
    {
        $this->contentCalendars = new ArrayCollection();
        $this->scheduledPosts = new ArrayCollection();
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

    public function getContentText(): ?string
    {
        return $this->contentText;
    }

    public function setContentText(?string $contentText): self
    {
        $this->contentText = $contentText;

        return $this;
    }

    public function getMediaUrls(): ?array
    {
        return $this->mediaUrls;
    }

    public function setMediaUrls(?array $mediaUrls): self
    {
        $this->mediaUrls = $mediaUrls;

        return $this;
    }

    public function getHashtags(): ?string
    {
        return $this->hashtags;
    }

    public function setHashtags(?string $hashtags): self
    {
        $this->hashtags = $hashtags;

        return $this;
    }

    public function getAiPrompt(): ?string
    {
        return $this->aiPrompt;
    }

    public function setAiPrompt(?string $aiPrompt): self
    {
        $this->aiPrompt = $aiPrompt;

        return $this;
    }

    public function getGeneratedAt(): ?\DateTimeInterface
    {
        return $this->generatedAt;
    }

    public function setGeneratedAt(\DateTimeInterface $generatedAt): self
    {
        $this->generatedAt = $generatedAt;

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

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;

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
            $contentCalendar->setContentItem($this);
        }

        return $this;
    }

    public function removeContentCalendar(ContentCalendar $contentCalendar): self
    {
        if ($this->contentCalendars->removeElement($contentCalendar)) {
            // set the owning side to null (unless already changed)
            if ($contentCalendar->getContentItem() === $this) {
                $contentCalendar->setContentItem(null);
            }
        }

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
            $scheduledPost->setContentItem($this);
        }

        return $this;
    }

    public function removeScheduledPost(ScheduledPost $scheduledPost): self
    {
        if ($this->scheduledPosts->removeElement($scheduledPost)) {
            // set the owning side to null (unless already changed)
            if ($scheduledPost->getContentItem() === $this) {
                $scheduledPost->setContentItem(null);
            }
        }

        return $this;
    }
}
