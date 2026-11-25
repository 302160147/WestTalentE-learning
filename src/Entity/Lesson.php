<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contents = null;

    #[ORM\ManyToOne(inversedBy: 'Lessons')]
    private ?Module $module = null;

    /**
     * @var Collection<int, Assignment>
     */
    #[ORM\OneToMany(targetEntity: Assignment::class, mappedBy: 'lesson')]
    private Collection $assignments;

    /**
     * @var Collection<int, Submission>
     */
    #[ORM\OneToMany(targetEntity: Submission::class, mappedBy: 'lesson')]
    private Collection $submissions;

    /**
     * @var Collection<int, Studentprogress>
     */
    #[ORM\OneToMany(targetEntity: Studentprogress::class, mappedBy: 'lesson')]
    private Collection $studentProgress;

    /**
     * @var Collection<int, Page>
     */
    #[ORM\OneToMany(targetEntity: Page::class, mappedBy: 'lesson')]
    private Collection $pages;

    public function __construct()
    {
        $this->assignments = new ArrayCollection();
        $this->submissions = new ArrayCollection();
        $this->studentProgress = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContents(): ?string
    {
        return $this->contents;
    }

    public function setContents(string $contents): static
    {
        $this->contents = $contents;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection<int, Assignment>
     */
    public function getAssignments(): Collection
    {
        return $this->assignments;
    }

    public function addAssignment(Assignment $assignment): static
    {
        if (!$this->assignments->contains($assignment)) {
            $this->assignments->add($assignment);
            $assignment->setLesson($this);
        }

        return $this;
    }

    public function removeAssignment(Assignment $assignment): static
    {
        if ($this->assignments->removeElement($assignment)) {
            // set the owning side to null (unless already changed)
            if ($assignment->getLesson() === $this) {
                $assignment->setLesson(null);
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
            $submission->setLesson($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): static
    {
        if ($this->submissions->removeElement($submission)) {
            // set the owning side to null (unless already changed)
            if ($submission->getLesson() === $this) {
                $submission->setLesson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Studentprogress>
     */
    public function getStudentProgress(): Collection
    {
        return $this->studentProgress;
    }

    public function addStudentProgress(Studentprogress $studentProgress): static
    {
        if (!$this->studentProgress->contains($studentProgress)) {
            $this->studentProgress->add($studentProgress);
            $studentProgress->setLesson($this);
        }

        return $this;
    }

    public function removeStudentProgress(Studentprogress $studentProgress): static
    {
        if ($this->studentProgress->removeElement($studentProgress)) {
            // set the owning side to null (unless already changed)
            if ($studentProgress->getLesson() === $this) {
                $studentProgress->setLesson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): static
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
            $page->setLesson($this);
        }

        return $this;
    }

    public function removePage(Page $page): static
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getLesson() === $this) {
                $page->setLesson(null);
            }
        }

        return $this;
    }
}
