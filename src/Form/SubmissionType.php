<?php

namespace App\Form;

use App\Entity\AnswerOption;
use App\Entity\Assignment;
use App\Entity\Submission;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubmissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('answerText')
//            ->add('isCorrect')
//            ->add('feedback')
//            ->add('submittedAt', null, [
//                'widget' => 'single_text'
//            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('assignment', EntityType::class, [
                'class' => Assignment::class,
                'choice_label' => 'id',
            ])
            ->add('answerOption', EntityType::class, [
                'class' => AnswerOption::class,
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
