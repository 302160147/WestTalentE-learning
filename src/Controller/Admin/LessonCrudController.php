<?php

namespace App\Controller\Admin;

use App\Entity\Lesson;
use App\Entity\Module;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class LessonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lesson::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ->setPermission(Action::EDIT, 'ROLE_ADMIN');
    }

    public function configureFields(string $pageName): iterable{

        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextField::new('name')
            ->setLabel('Naam');

        yield TextField::new('description')
            ->setLabel('Beschrijving');

        yield TextField::new('contents')
            ->setLabel('Inhoud');

        yield AssociationField::new('module')->autocomplete(
            callback: static fn (module $module): string => sprintf('%s', $module->getName()),
        );
    }
}
