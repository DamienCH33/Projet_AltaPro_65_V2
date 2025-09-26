<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control', 'placeholder' => 'Votre nom']
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control', 'placeholder' => 'Votre prénom']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [new NotBlank(), new Email()],
                'attr' => ['class' => 'form-control', 'placeholder' => 'exemple@email.com']
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control', 'placeholder' => '+33 6 12 34 56 78']
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control', 'rows' => 6]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ])
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

