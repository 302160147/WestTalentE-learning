<?php

namespace App\Form;

use App\Entity\AnswerOption;
use App\Entity\Assignment;
use App\Entity\Lesson;
use App\Entity\Submission;
use App\Entity\User;
use App\Repository\AnswerOptionRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class SubmissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $submission = $options['data'] ?? null;
        $assignment = $submission?->getAssignment();
        $builder
            ->add('answerText')
            ->add('answerOption', EntityType::class, [
                'multiple' => true,
                'expanded' => true,
                'class' => AnswerOption::class,
                'query_builder' => function (EntityRepository $entityRepository) use ($assignment) {
                    $queryBuilder = $entityRepository->createQueryBuilder('o');

                    if($assignment){
                        $queryBuilder->andWhere('o.assignment = :assignment')
                            ->setParameter('assignment', $assignment);
                    } else {
                        $queryBuilder->andWhere('o.assignment IS NULL');
                    }

                    return $queryBuilder->orderBy('o.optionText', 'ASC');
                },
                'choice_label' => function (?AnswerOption $answerOption): string {
                    return $answerOption ? strtoupper((string) $answerOption->getOptionText()) : '';
                },
                'choice_attr' => function (?AnswerOption $answerOption) {
                    return $answerOption ? ['data-answer-text' => (string) $answerOption->getOptionText()] : [];
                },
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
                $submission = $event->getData();
                $selectedOption = $submission->getAnswerOption();

                if ($selectedOption !== null) {
                    $submission->setAnswerText($selectedOption);
                }
                $selectedTexts = [];
                foreach ($submission->getAnswerOption() as $option) {
                    $selectedTexts[] = $option->getOptionText();
                }


                $submission->setAnswerText(implode(', ', $selectedTexts));
            })
            ->add('submittedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('assignment', EntityType::class, [
                'class' => Assignment::class,
                'choice_label' => 'id',
            ])
            ->add('lesson', EntityType::class, [
                'class' => Lesson::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Submission::class,
        ]);
    }
}
