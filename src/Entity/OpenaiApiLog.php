<?php

namespace App\Entity;

use App\Repository\OpenaiApiLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OpenaiApiLogRepository::class)
 */
class OpenaiApiLog
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
    private $endpoint;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $requestData = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $responseData = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $tokensUsed;

    /**
     * @ORM\Column(type="integer")
     */
    private $durationMs;

    /**
     * @ORM\Column(type="integer")
     */
    private $statusCode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="openaiApiLogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getRequestData(): ?array
    {
        return $this->requestData;
    }

    public function setRequestData(?array $requestData): self
    {
        $this->requestData = $requestData;

        return $this;
    }

    public function getResponseData(): ?array
    {
        return $this->responseData;
    }

    public function setResponseData(?array $responseData): self
    {
        $this->responseData = $responseData;

        return $this;
    }

    public function getTokensUsed(): ?int
    {
        return $this->tokensUsed;
    }

    public function setTokensUsed(int $tokensUsed): self
    {
        $this->tokensUsed = $tokensUsed;

        return $this;
    }

    public function getDurationMs(): ?int
    {
        return $this->durationMs;
    }

    public function setDurationMs(int $durationMs): self
    {
        $this->durationMs = $durationMs;

        return $this;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

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
}
