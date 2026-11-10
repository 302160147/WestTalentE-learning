<?php

namespace App\Entity;

use App\Repository\AssignmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssignmentRepository::class)]
class Assignment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(length: 50)]
    private ?string $questionType = null;

    #[ORM\ManyToOne(inversedBy: 'assignments')]
    private ?Lesson $lesson = null;

    /**
     * @var Collection<int, AnswerOption>
     */
    #[ORM\OneToMany(targetEntity: AnswerOption::class, mappedBy: 'assignment')]
    private Collection $answerOptions;

    /**
     * @var Collection<int, Submission>
     */
    #[ORM\OneToMany(targetEntity: Submission::class, mappedBy: 'assignment')]
    private Collection $submissions;

    public function __construct()
    {
        $this->answerOptions = new ArrayCollection();
        $this->submissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getQuestionType(): ?string
    {
        return $this->questionType;
    }

    public function setQuestionType(string $questionType): static
    {
        $this->questionType = $questionType;

        return $this;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): static
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * @return Collection<int, AnswerOption>
     */
    public function getAnswerOptions(): Collection
    {
        return $this->answerOptions;
    }

    public function addAnswerOption(AnswerOption $answerOption): static
    {
        if (!$this->answerOptions->contains($answerOption)) {
            $this->answerOptions->add($answerOption);
            $answerOption->setAssignment($this);
        }

        return $this;
    }

    public function removeAnswerOption(AnswerOption $answerOption): static
    {
        if ($this->answerOptions->removeElement($answerOption)) {
            // set the owning side to null (unless already changed)
            if ($answerOption->getAssignment() === $this) {
                $answerOption->setAssignment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Submission>
     */
    public function getSubmissions(): Collection
    {
        return $this->submissions;
    }

    public function addSubmission(Submission $submission): static
    {
        if (!$this->submissions->contains($submission)) {
            $this->submissions->add($submission);
            $submission->setAssignment($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): static
    {
        if ($this->submissions->removeElement($submission)) {
            // set the owning side to null (unless already changed)
            if ($submission->getAssignment() === $this) {
                $submission->setAssignment(null);
            }
        }

        return $this;
    }
}
