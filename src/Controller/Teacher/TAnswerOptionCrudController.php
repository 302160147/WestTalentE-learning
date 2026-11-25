<?php

namespace App\Controller\Teacher;

use App\Entity\AnswerOption;
use App\Entity\Assignment;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TAnswerOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnswerOption::class;
    }

    public function configureFields(string $pageName, ): iterable{

        yield IdField::new('id')
            ->onlyOnIndex();


        if ($pageName === Crud::PAGE_NEW) {
            yield ArrayField::new('bulkOptionTexts', 'optionText')
                ->hideOnIndex();
        } else {
            yield TextField::new('optionText')
                ->setLabel('Meerkeuze of juist/onjuist vraag opties');
        }

        yield TextareaField::new('isCorrect')
            ->setLabel('Wat is het goede antwoord');

        yield AssociationField::new('assignment')
            ->autocomplete(callback: static fn (assignment $assignment): string => sprintf('%s', $assignment->getQuestion()),)
            ->setRequired(true);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entity): void
    {

        if (!$entity instanceof AnswerOption) {
            return;
        }

        $assignment = $entity->getAssignment();

        if ($assignment && method_exists($assignment, 'removeAnswerOption')) {
            $assignment->removeAnswerOption($entity);
        }

        $entityManager->detach($entity);

        foreach ($entity->bulkOptionTexts as $text) {
            if (trim((string) $text) === '') {
                continue;
            }

            $option = new AnswerOption();
            $option->setAssignment($entity->getAssignment());
            $option->setOptionText((string) $text);

            $entityManager->persist($option);
        }
        $entityManager->flush();
    }
}
