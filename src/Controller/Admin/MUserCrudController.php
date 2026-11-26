<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FilterFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use JorisDugue\EasyAdminExtraBundle\Attribute\AdminImport;
use JorisDugue\EasyAdminExtraBundle\Contract\ImportFieldsProviderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use JorisDugue\EasyAdminExtraBundle\Field\TextImportField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

#[AdminImport]
class MUserCrudController extends AbstractCrudController implements ImportFieldsProviderInterface
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function export(AdminContext $context, CsvExporter $csvExporter)
    {
        $fields = new FieldCollection($this->configureFields(Crud::PAGE_INDEX));
        $filters = $this->container->get(FilterFactory::class)->create($context->getCrud()->getFiltersConfig(), $fields, $context->getEntity());
        $queryBuilder = $this->createIndexQueryBuilder($context->getSearch(), $context->getEntity(), $fields, $filters);

        return $csvExporter->createResponeFromQueryBuilder(
                    $queryBuilder,
                    $fields,
                    ''
        );
    }

    public function configureActions(Actions $actions): Actions
    {

        $exportAction = Action::new('export')
            ->linkToCrudAction('export')
            ->addCssClass('btn btn-success')
            ->setIcon('fa fa-download')
            ->createAsGlobalAction();

        return parent::configureActions($actions)

            ->add(Crud::PAGE_INDEX, $exportAction);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextField::new('FullName')
            ->setLabel('Naam')
            ->onlyOnIndex();

        yield TextField::new('firstName')
            ->setLabel('Voornaam')
            ->hideOnIndex();

        yield TextField::new('lastName')
            ->setLabel('Achternaam')
            ->hideOnIndex();

        yield EmailField::new('email')
            ->setLabel('email');

        yield AssociationField::new('niveau')
            ->setLabel('Niveau')
            ->autocomplete();

        yield TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Password',
                    'hash_property_path' => 'password',
                ],
                'second_options' => ['label' => '(Repeat)'],
                'mapped' => false,
            ])
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms();

        yield ChoiceField::new('roles')
            ->setLabel('rol')
            ->allowMultipleChoices()
            ->renderAsBadges([
                'ROLE_ADMIN' => 'danger',
                'ROLE_EDITOR' => 'warning',
                'ROLE_USER' => 'secondary',
            ])
            ->setChoices([
                'Admin' => 'ROLE_ADMIN',
                'Teacher' => 'ROLE_TEACHER',
                'Student' => 'ROLE_STUDENT',
            ]);
    }
    public static function getImportFields(?string $importSet = null): array
    {
        return [
            TextImportField::new('email'),
//            ChoiceImportField::new('roles')
//                ->setChoices([
//                    'Teacher' => 'ROLE_TEACHER',
//                    'Student' => 'ROLE_STUDENT',
//                ]),
//            TextImportField::new('roles'),
            TextImportField::new('password'),
            TextImportField::new('firstName'),
            TextImportField::new('lastName'),
//            ChoiceImportField::new('niveau.id')
//                ->setChoices([
//                    'Niveau 2' => '2',
//                    'Niveau 3' => '3',
//                    'Niveau 4' => '4',
//                ]),
        ];
    }
}
