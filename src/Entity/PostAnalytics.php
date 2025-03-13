<?php

namespace App\Entity;

use App\Repository\PostAnalyticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostAnalyticsRepository::class)
 */
class PostAnalytics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $likes;

    /**
     * @ORM\Column(type="integer")
     */
    private $comments;

    /**
     * @ORM\Column(type="integer")
     */
    private $shares;

    /**
     * @ORM\Column(type="integer")
     */
    private $clicks;

    /**
     * @ORM\Column(type="integer")
     */
    private $impressions;

    /**
     * @ORM\Column(type="integer")
     */
    private $reach;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $engagementRate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastUpdated;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $rawData = [];

    /**
     * @ORM\OneToOne(targetEntity=ScheduledPost::class, inversedBy="postAnalytics", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $scheduledPost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getComments(): ?int
    {
        return $this->comments;
    }

    public function setComments(int $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getShares(): ?int
    {
        return $this->shares;
    }

    public function setShares(int $shares): self
    {
        $this->shares = $shares;

        return $this;
    }

    public function getClicks(): ?int
    {
        return $this->clicks;
    }

    public function setClicks(int $clicks): self
    {
        $this->clicks = $clicks;

        return $this;
    }

    public function getImpressions(): ?int
    {
        return $this->impressions;
    }

    public function setImpressions(int $impressions): self
    {
        $this->impressions = $impressions;

        return $this;
    }

    public function getReach(): ?int
    {
        return $this->reach;
    }

    public function setReach(int $reach): self
    {
        $this->reach = $reach;

        return $this;
    }

    public function getEngagementRate(): ?string
    {
        return $this->engagementRate;
    }

    public function setEngagementRate(string $engagementRate): self
    {
        $this->engagementRate = $engagementRate;

        return $this;
    }

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(\DateTimeInterface $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    public function getRawData(): ?array
    {
        return $this->rawData;
    }

    public function setRawData(?array $rawData): self
    {
        $this->rawData = $rawData;

        return $this;
    }

    public function getScheduledPost(): ?ScheduledPost
    {
        return $this->scheduledPost;
    }

    public function setScheduledPost(ScheduledPost $scheduledPost): self
    {
        $this->scheduledPost = $scheduledPost;

        return $this;
    }
}
