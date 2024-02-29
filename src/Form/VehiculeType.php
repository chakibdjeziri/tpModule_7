<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '1',
                    'maxlength' => '100'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 100]),
                    new Assert\NotBlank()
                ]
            ])

            ->add('modele', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '1',
                    'maxlength' => '100'
                ],
                'label' => 'modéle',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 100]),
                    new Assert\NotBlank()
                ]
            ])

            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '1',
                    'maxlength' => '65000'
                ],
                'label' => 'déscription',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 65000]),
                    new Assert\NotBlank()
                ]
            ])

            ->add('image', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '1',
                    'maxlength' => '255'
                ],
                'label' => 'URL de l\'image',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 255]),
                    new Assert\NotBlank()
                ]
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Créer un véhicule'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
