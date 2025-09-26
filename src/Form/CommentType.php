<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control', 'placeholder' => 'Votre nom']
            ])
            ->add('firstname', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control', 'placeholder' => 'Votre prénom']
            ])
            ->add('comment', TextareaType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control', 'rows' => 6, 'placeholder' => 'Donnez votre avis']
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'Donnez une note',
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5],
                'expanded' => true,
                'multiple' => false,
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'rating'],
                'choice_label' => function ($choice, $key, $value) {
                    return '★';  // **chaque label = 1 étoile**
                },
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
