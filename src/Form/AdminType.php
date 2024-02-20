<?php

namespace App\Form;

use App\Entity\UserAdmin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


use Symfony\Component\Validator\Constraints as Assert;



class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
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
                    new Assert\Length(['min' => 1, 'max' => 100])
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary m-4'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserAdmin::class,
        ]);
    }
}
