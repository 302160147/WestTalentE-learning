<?php

namespace App\Entity;

use App\Repository\AnswerOptionRepository;
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
}
