<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Vardas',
                'constraints' => [
                    new Length(['max' => 255]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/u',
                        'message' => "Varde gali būti tik raidės!"
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Vardas'
                ]
            ])
            ->add('surname', TextType::class, [
                'label' => 'Pavardė',
                'constraints' => [
                    new Length(['max' => 255]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/u',
                        'message' => "Pavardėje gali būti tik raidės!"
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pavardė'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'El. paštas',
                'constraints' => [new Length(['max' => 255])],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'El. paštas'
                ]
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Telefono numeris',
                'constraints' => [
                    new Length(['min' => 8,'max' => 15]),
                    new Regex([
                        'pattern' => '/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.0-9]*$/',
                        'message' => "Blogas telefono numerio formatas!"
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '+37099999999',
                    'pattern' => '+370[0-9]{8}'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_name' => 'first',
                'second_name' => 'second',
                'constraints' => [
                    new Length(['min' => 8,'max' => 255]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/',
                        'message' => "Slaptažodyje turi būti bent viena didžioji raidė, mažoji raidė bei skaičius"
                    ])
                ],
                'first_options' => [
                    'attr' => ['class' => 'form-control'],
                    'label' => 'Slaptažodis'
                ],
                'second_options' => [
                    'attr' => ['class' => 'form-control'],
                    'label' => 'Pakartoti slaptažodį'
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Registruotis'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
