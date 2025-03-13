<?php

namespace App\Entity;

use App\Repository\ScheduledPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduledPostRepository::class)
 */
class ScheduledPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $scheduledFor;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $customText;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $postStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postUrl;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $errorMessage;

    /**
     * @ORM\ManyToOne(targetEntity=ContentItem::class, inversedBy="scheduledPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contentItem;

    /**
     * @ORM\ManyToOne(targetEntity=SocialAccount::class, inversedBy="scheduledPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $socialAccount;

    /**
     * @ORM\OneToOne(targetEntity=PostAnalytics::class, mappedBy="scheduledPost", cascade={"persist", "remove"})
     */
    private $postAnalytics;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScheduledFor(): ?\DateTimeInterface
    {
        return $this->scheduledFor;
    }

    public function setScheduledFor(\DateTimeInterface $scheduledFor): self
    {
        $this->scheduledFor = $scheduledFor;

        return $this;
    }

    public function getCustomText(): ?string
    {
        return $this->customText;
    }

    public function setCustomText(?string $customText): self
    {
        $this->customText = $customText;

        return $this;
    }

    public function getPostStatus(): ?string
    {
        return $this->postStatus;
    }

    public function setPostStatus(string $postStatus): self
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    public function getPostId(): ?string
    {
        return $this->postId;
    }

    public function setPostId(?string $postId): self
    {
        $this->postId = $postId;

        return $this;
    }

    public function getPostUrl(): ?string
    {
        return $this->postUrl;
    }

    public function setPostUrl(?string $postUrl): self
    {
        $this->postUrl = $postUrl;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;

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

    public function getSocialAccount(): ?SocialAccount
    {
        return $this->socialAccount;
    }

    public function setSocialAccount(?SocialAccount $socialAccount): self
    {
        $this->socialAccount = $socialAccount;

        return $this;
    }

    public function getPostAnalytics(): ?PostAnalytics
    {
        return $this->postAnalytics;
    }

    public function setPostAnalytics(PostAnalytics $postAnalytics): self
    {
        // set the owning side of the relation if necessary
        if ($postAnalytics->getScheduledPost() !== $this) {
            $postAnalytics->setScheduledPost($this);
        }

        $this->postAnalytics = $postAnalytics;

        return $this;
    }
}
