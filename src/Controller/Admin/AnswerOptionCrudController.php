<?php

namespace App\Controller\Admin;

use App\Entity\AnswerOption;
use App\Entity\Module;
use App\Entity\Assignment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class AnswerOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnswerOption::class;
    }

    public function configureFields(string $pageName, ): iterable{



        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextField::new('optionText')
            ->setLabel('Antwoord');

        yield ChoiceField::new('optionText')->renderExpanded()
            ->allowMultipleChoices()
            ->setLabel('Meerkeuze vraag')
            ->hideOnIndex();

        yield TextareaField::new('optionText')
            ->setLabel('Open vraag')
            ->hideOnIndex();

        yield ChoiceField::new('optionText')->renderExpanded()
            ->setLabel('Juist onjuist vraag')
            ->hideOnIndex();

        yield IntegerField::new('isCorrect')
            ->setLabel('Is de vraag goed of niet?');

        yield AssociationField::new('assignment')->autocomplete(
            callback: static fn (assignment $assignment): string => sprintf('%s', $assignment->getId()),
        );
    }
}
