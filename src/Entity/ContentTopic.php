<?php

namespace App\Entity;

use App\Repository\ContentTopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentTopicRepository::class)
 */
class ContentTopic
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $keywords;

    /**
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessProfile::class, inversedBy="contentTopics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $businessProfile;

    /**
     * @ORM\OneToMany(targetEntity=ContentCalendar::class, mappedBy="topic")
     */
    private $contentCalendars;

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
            $contentCalendar->setTopic($this);
        }

        return $this;
    }

    public function removeContentCalendar(ContentCalendar $contentCalendar): self
    {
        if ($this->contentCalendars->removeElement($contentCalendar)) {
            // set the owning side to null (unless already changed)
            if ($contentCalendar->getTopic() === $this) {
                $contentCalendar->setTopic(null);
            }
        }

        return $this;
    }
}
