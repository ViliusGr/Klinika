<?php

namespace App\Form;

use App\Entity\Schedule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('duration', ChoiceType::class, [
                'label' => 'Vieno apsilankymo trukmė',
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => [
                    '10 minučių' => 10,
                    '15 minučių' => 15,
                    '20 minučių' => 20,
                    '30 minučių' => 30,
                    '45 minutės' => 45,
                    '1 valanda' => 60,
                    '1 valanda 30 minučių' => 90,
                    '2 valandos' => 120
                ]
            ])
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
            ->add('days', CollectionType::class, [
                'label' => false,
                'entry_type' => DayScheduleType::class,
                'attr' => [
                    'class' => 'form-row'
                ],
                'entry_options' => [

                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Išsaugoti'
            ])
        ;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $dienos = ["Pirmadienis", "Antradienis", "Trečiadienis", "Ketvirtadienis", "Penktadienis", "Šeštadienis", "Sekmadienis"];
        $i = 0;
        foreach ($view['days']->children as $childView)
        {
            $childView->vars['label'] = $dienos[$i];
            $i++;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class,
        ]);
    }
}
