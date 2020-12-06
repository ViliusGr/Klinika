<?php

namespace App\Form;

use App\Entity\Appointment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('doctor', EntityType::class, [
                'label' => 'Daktaras',
                'class' => 'App\Entity\Doctor',
                'choice_label' => function ($doctor) {
                    return $doctor->getUser()->getFullName();
                },
                'placeholder' => 'Pasirinkite gydytoją',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('date', TextType::class, [
                'label' => 'Data',
                'attr' => [
                    'class' => 'form-control datepicker'
                ]
            ])
            ->add('time', TextType::class, [
                'label' => 'Laikas',
                'attr' => [
                    'class' => 'form-control timepicker'
                ]
            ])
            ->add('info', TextareaType::class, [
                'label' => 'Simptomai:',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Įveskite savo simptomus čia...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
