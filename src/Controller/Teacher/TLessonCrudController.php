<?php

namespace App\Controller\Teacher;

use App\Entity\Lesson;
use App\Entity\Module;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TLessonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lesson::class;
    }

    public function configureFields(string $pageName): iterable{

        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextField::new('name')
            ->setLabel('Naam');

        yield TextField::new('description')
            ->setLabel('Beschrijving');

        yield TextareaField::new('contents')->renderAsHtml()
            ->setLabel('Inhoud');

        yield AssociationField::new('module')->autocomplete(
            callback: static fn (module $module): string => sprintf('%s', $module->getName()),
        );
    }
}
