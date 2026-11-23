<?php

namespace App\Controller\Admin;

use App\Entity\Submission;
use App\Entity\User;
use App\Entity\Assignment;
use App\Entity\AnswerOption;
use App\Entity\Lesson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class SubmissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Submission::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextField::new('answerText')
            ->setLabel('antwoord');

        yield TextField::new('isCorrect')
            ->setLabel('is het goed?');

        yield TextField::new('Feedback')
            ->setLabel('feedback');

        yield DateField::new('submittedAt')->renderAsChoice();

        yield AssociationField::new('user')
            ->autocomplete(callback: static fn (User $user): string => sprintf('%s', $user->getId()));

        yield AssociationField::new('assignment')
            ->autocomplete(callback: static fn (Assignment $assignment): string => sprintf('%s', $assignment->getId()));

        yield AssociationField::new('answerOption')
            ->autocomplete(callback: static fn (AnswerOption $answeroption): string => sprintf('%s', $answeroption->getId()));

        yield AssociationField::new('lesson')
            ->autocomplete(callback: static fn (Lesson $lesson): string => sprintf('%s', $lesson->getId()));
    }
}
