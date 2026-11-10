<?php

namespace App\Entity;

use App\Repository\StudentprogressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentprogressRepository::class)]
class Studentprogress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $completedLesson = null;

    #[ORM\Column]
    private ?int $totalLessons = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'studentProgress')]
    private ?Module $module = null;

    #[ORM\ManyToOne(inversedBy: 'studentProgresses')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompletedLesson(): ?int
    {
        return $this->completedLesson;
    }

    public function setCompletedLesson(int $completedLesson): static
    {
        $this->completedLesson = $completedLesson;

        return $this;
    }

    public function getTotalLessons(): ?int
    {
        return $this->totalLessons;
    }

    public function setTotalLessons(int $totalLessons): static
    {
        $this->totalLessons = $totalLessons;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
