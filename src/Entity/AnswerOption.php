<?php

namespace App\Entity;

use App\Repository\AnswerOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerOptionRepository::class)]
class AnswerOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $optionText = null;

    #[ORM\Column(nullable: true)]
    private ?int $isCorrect = null;

    #[ORM\ManyToOne(inversedBy: 'answerOptions')]
    private ?Assignment $assignment = null;

    /**
     * @var Collection<int, Submission>
     */
    #[ORM\OneToMany(targetEntity: Submission::class, mappedBy: 'answerOption')]
    private Collection $submissions;

    public function __construct()
    {
        $this->submissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOptionText(): ?string
    {
        return $this->optionText;
    }

    public function setOptionText(string $optionText): static
    {
        $this->optionText = $optionText;

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

    public function getAssignment(): ?Assignment
    {
        return $this->assignment;
    }

    public function setAssignment(?Assignment $assignment): static
    {
        $this->assignment = $assignment;

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
            $submission->setAnswerOption($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): static
    {
        if ($this->submissions->removeElement($submission)) {
            // set the owning side to null (unless already changed)
            if ($submission->getAnswerOption() === $this) {
                $submission->setAnswerOption(null);
            }
        }

        return $this;
    }
}
