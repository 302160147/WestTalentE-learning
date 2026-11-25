<?php

namespace App\Form;

use App\Entity\AnswerOption;
use App\Entity\Submission;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubmissionJType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $submission = $options['data'] ?? null;
        $assignment = $submission?->getAssignment();
        $builder
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

                $selectedTexts = [];
                foreach ($submission->getAnswerOption() as $option) {
                    $selectedTexts[] = $option->getOptionText();
                }

                $submission->setAnswerText(implode(', ', $selectedTexts));
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Submission::class,
        ]);
    }
}
