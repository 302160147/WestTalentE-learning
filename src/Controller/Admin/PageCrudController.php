<?php

namespace App\Controller\Admin;

use App\Entity\AnswerOption;
use App\Entity\Assignment;
use App\Entity\Lesson;
use App\Entity\Page;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextField::new('title')
            ->setLabel('Titel');

        yield TextField::new('info')
            ->setLabel('Informatie');

        yield TextareaField::new('content')
            ->setLabel('Inhoud');

        yield ImageField::new('img')->setUploadDir('assets/images')
            ->setLabel('foto');


        yield AssociationField::new('lesson')
            ->autocomplete(callback: static fn (Lesson $lesson): string => sprintf('%s', $lesson->getId()));
    }
}
