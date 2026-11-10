<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    private ?Vak $vak = null;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    private ?Niveau $niveau = null;

    /**
     * @var Collection<int, Lesson>
     */
    #[ORM\OneToMany(targetEntity: Lesson::class, mappedBy: 'module')]
    private Collection $Lessons;

    /**
     * @var Collection<int, StudentProgress>
     */
    #[ORM\OneToMany(targetEntity: StudentProgress::class, mappedBy: 'module')]
    private Collection $studentProgress;

    public function __construct()
    {
        $this->Lessons = new ArrayCollection();
        $this->studentProgress = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVak(): ?Vak
    {
        return $this->vak;
    }

    public function setVak(?Vak $vak): static
    {
        $this->vak = $vak;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->Lessons;
    }

    public function addLesson(Lesson $lesson): static
    {
        if (!$this->Lessons->contains($lesson)) {
            $this->Lessons->add($lesson);
            $lesson->setModule($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): static
    {
        if ($this->Lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getModule() === $this) {
                $lesson->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StudentProgress>
     */
    public function getStudentProgress(): Collection
    {
        return $this->studentProgress;
    }

    public function addStudentProgress(StudentProgress $studentProgress): static
    {
        if (!$this->studentProgress->contains($studentProgress)) {
            $this->studentProgress->add($studentProgress);
            $studentProgress->setModule($this);
        }

        return $this;
    }

    public function removeStudentProgress(StudentProgress $studentProgress): static
    {
        if ($this->studentProgress->removeElement($studentProgress)) {
            // set the owning side to null (unless already changed)
            if ($studentProgress->getModule() === $this) {
                $studentProgress->setModule(null);
            }
        }

        return $this;
    }
}
