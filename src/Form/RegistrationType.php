<?php

namespace App\Form;

use App\Entity\UserAdmin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;



class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'pseudo',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'minlenght' => '1',
                        'maxlenght' => '100',
                    ],
                    'required' => true,
                    'label' => 'Pseudo',
                    'label_attr' => [
                        'class' => 'form-label  mt-4'
                    ],
                    'constraints' => [
                        new Assert\Length(['min' => 1, 'max' => 100]),
                        new Assert\NotBlank()
                    ]
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'minlenght' => '1',
                        'maxlenght' => '180',
                    ],
                    'label' => 'Adresse email',
                    'label_attr' => [
                        'class' => 'form-label  mt-4'
                    ],
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Email(),
                        new Assert\Length(['min' => 1, 'max' => 180])
                    ]
                ]
            )
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options' => [
                        'attr' => [
                            'class' => 'form-control'
                        ],
                        'label' => 'Mot de passe',
                        'label_attr' => [
                            'class' => 'form-label  mt-4'
                        ]
                    ],
                    'second_options' => [
                        'attr' => [
                            'class' => 'form-control'
                        ],
                        'label' => 'Confirmation du mot de passe',
                        'label_attr' => [
                            'class' => 'form-label mt-4'
                        ]
                    ],
                    'invalid_message' => 'Les mots de passe ne correspondent pas.',
                ]
            )
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary m-4'
                ], 'label' => 'Inscription'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserAdmin::class,
        ]);
    }
}