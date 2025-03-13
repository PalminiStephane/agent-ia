<?php

namespace App\Entity;

use App\Repository\ContentCalendarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentCalendarRepository::class)
 */
class ContentCalendar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $platform;

    /**
     * @ORM\Column(type="date")
     */
    private $plannedDate;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $contentType;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessProfile::class, inversedBy="contentCalendars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $businessProfile;

    /**
     * @ORM\ManyToOne(targetEntity=ContentTopic::class, inversedBy="contentCalendars")
     */
    private $topic;

    /**
     * @ORM\ManyToOne(targetEntity=ContentItem::class, inversedBy="contentCalendars")
     */
    private $contentItem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getPlannedDate(): ?\DateTimeInterface
    {
        return $this->plannedDate;
    }

    public function setPlannedDate(\DateTimeInterface $plannedDate): self
    {
        $this->plannedDate = $plannedDate;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

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

    public function getTopic(): ?ContentTopic
    {
        return $this->topic;
    }

    public function setTopic(?ContentTopic $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getContentItem(): ?ContentItem
    {
        return $this->contentItem;
    }

    public function setContentItem(?ContentItem $contentItem): self
    {
        $this->contentItem = $contentItem;

        return $this;
    }
}
