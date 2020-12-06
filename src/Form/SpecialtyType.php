<?php

namespace App\Form;

use App\Entity\Specialty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SpecialtyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', NumberType::class, [
                'label' => 'Specialybės kodas',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '------'
                ],
                'constraints' => [new Length(['min' => 4,'max' => 6])]
            ])
            ->add('name', TextType::class, [
                'label' => 'Pavadinimas',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pavadinimas'
                ],
                'constraints' => [new Length(['max' => 255])]
            ])
            ->add('subgroup', TextType::class, [
                'label' => 'Pogrupis',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pogrupis'
                ],
                'constraints' => [new Length(['max' => 255])]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Išsaugoti'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Specialty::class,
        ]);
    }
}
