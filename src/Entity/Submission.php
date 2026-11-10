<?php

namespace App\Entity;

use App\Repository\SubmissionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubmissionRepository::class)]
class Submission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answerText = null;

    #[ORM\Column(nullable: true)]
    private ?int $isCorrect = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $feedback = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $submittedAt = null;

    #[ORM\ManyToOne(inversedBy: 'submissions')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'submissions')]
    private ?Assignment $assignment = null;

    #[ORM\ManyToOne(inversedBy: 'submissions')]
    private ?AnswerOption $answerOption = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswerText(): ?string
    {
        return $this->answerText;
    }

    public function setAnswerText(?string $answerText): static
    {
        $this->answerText = $answerText;

        return $this;
    }

    public function getIsCorrect(): ?int
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(?int $isCorrect): static
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    public function getFeedback(): ?string
    {
        return $this->feedback;
    }

    public function setFeedback(?string $feedback): static
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function getSubmittedAt(): ?\DateTimeImmutable
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(\DateTimeImmutable $submittedAt): static
    {
        $this->submittedAt = $submittedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAssignment(): ?Assignment
    {
        return $this->assignment;
    }

    public function setAssignment(?Assignment $assignment): static
    {
        $this->assignment = $assignment;

        return $this;
    }

    public function getAnswerOption(): ?AnswerOption
    {
        return $this->answerOption;
    }

    public function setAnswerOption(?AnswerOption $answerOption): static
    {
        $this->answerOption = $answerOption;

        return $this;
    }
}
