<?php

namespace App\Entity;

use App\Repository\AnswerOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $isCorrect = null;

    #[ORM\ManyToOne(inversedBy: 'answerOptions')]
    private ?Assignment $assignment = null;

    /**
     * @var Collection<int, Submission>
     */
    #[ORM\ManyToMany(targetEntity: Submission::class, mappedBy: 'answerOption')]
    private Collection $submissions;

    /**
     * @var Collection<int, Submission>
     */

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

    public function getIsCorrect(): ?string
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(?string $isCorrect): static
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
            $submission->addAnswerOption($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): static
    {
        if ($this->submissions->removeElement($submission)) {
            $submission->removeAnswerOption($this);
        }

        return $this;
    }
    public array $bulkOptionTexts = [];
}
