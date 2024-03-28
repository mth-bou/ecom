<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['autocomplete' => 'given-name']
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['autocomplete' => 'family-name'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer votre nom.',
                    ]),
                ],
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['autocomplete' => 'bday'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer votre date de naissance.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['autocomplete' => 'email'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer une adresse email.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un mot de passe.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('address', TextType::class, [
                'attr' => ['autocomplete' => 'address'],
            ])
            ->add('city', TextType::class, [
                'attr' => ['autocomplete' => 'address-level2'],
            ])
            ->add('country', TextType::class, [
                'attr' => ['autocomplete' => 'country'],
            ])
            ->add('phone', TextType::class, [
                'attr' => ['autocomplete' => 'tel'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
