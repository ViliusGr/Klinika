<?php

namespace App\Form;

use App\Entity\DaySchedule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('timeFrom', TextType::class, [
                'label' => 'Laikas nuo',
                'attr' => [
                    'class' => 'form-control timepicker'
                ]
            ])
            ->add('timeTo', TextType::class, [
                'label' => 'Laikas iki',
                'attr' => [
                    'class' => 'form-control timepicker'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DaySchedule::class,
        ]);
    }
}
