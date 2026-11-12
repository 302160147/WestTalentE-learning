<?php

namespace App\Controller\Admin;

use App\Entity\Assignment;
use App\Entity\Module;
use App\Entity\Lesson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AssignmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Assignment::class;
    }

    public function configureFields(string $pageName): iterable{

        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextareaField::new('question')->renderAsHtml()
            ->setLabel('Vraag');

        yield ChoiceField::new('questionType')->autocomplete()
            ->setLabel('Soort vraag')
            ->renderAsBadges([
                'Meerkeuze vraag' => 'info',
                'Open vraag' => 'primary',
                'Juist onjuist vraag' => 'success',
            ])
            ->setChoices([
                'Meerkeuze vraag' => 'Meerkeuze vraag',
                'Open vraag' => 'Open vraag',
                'Juist onjuist vraag' => 'Juist onjuist vraag',
            ]);

        yield AssociationField::new('lesson')->autocomplete(
            callback: static fn (lesson $module): string => sprintf('%s', $module->getName()),
        );
    }
}
