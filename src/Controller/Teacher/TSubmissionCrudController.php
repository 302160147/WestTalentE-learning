<?php

namespace App\Controller\Teacher;

use App\Entity\AnswerOption;
use App\Entity\Assignment;
use App\Entity\Lesson;
use App\Entity\Submission;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TSubmissionCrudController extends AbstractCrudController
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
            ->setLabel('feedback')
            ->setPermission('ROLE_ADMIN');

        yield DateField::new('submittedAt')->renderAsChoice()
            ->setPermission('ROLE_ADMIN');

        yield AssociationField::new('user')
            ->autocomplete(callback: static fn (User $user): string => sprintf('%s', $user->getId()))
            ->setPermission('ROLE_ADMIN');

        yield AssociationField::new('assignment')
            ->autocomplete(callback: static fn (Assignment $assignment): string => sprintf('%s', $assignment->getId()))
            ->setPermission('ROLE_ADMIN');

        yield AssociationField::new('answerOption')
            ->autocomplete(callback: static fn (AnswerOption $answeroption): string => sprintf('%s', $answeroption->getId()))
            ->onlyOnIndex();


        yield AssociationField::new('lesson')
            ->autocomplete(callback: static fn (Lesson $lesson): string => sprintf('%s', $lesson->getId()))
            ->setPermission('ROLE_ADMIN');
    }
}
