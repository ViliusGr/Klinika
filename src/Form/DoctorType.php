<?php

namespace App\Form;

use App\Entity\Doctor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emplid', TextType::class, [
                'label' => 'Tabelio numeris',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0000'
                ],
                'constraints' => [new Length(['min' => 4,'max' => 20])]
            ])
            ->add('specialty', EntityType::class, [
                'label' => 'Specialybė',
                'class' => 'App\Entity\Specialty',
                'choice_label' => 'name',
                'placeholder' => 'Pasirinkite gydytojo specialybę',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('user', UserType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
