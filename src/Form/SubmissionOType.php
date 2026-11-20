<?php

namespace App\Form;

use App\Entity\AnswerOption;
use App\Entity\Assignment;
use App\Entity\Lesson;
use App\Entity\Submission;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubmissionOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('answerText')
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
            ->add('answerOption', EntityType::class, [
                'class' => AnswerOption::class,
                'choice_label' => 'id',
                'multiple' => true,
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
