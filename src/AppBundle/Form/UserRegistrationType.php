<?php
// src/AppBundle/Form/UserRegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;

class UserRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'username',               // Label text shown
                'label_attr' => [                      // Attributes for <label> tag
                    'class' => 'control-label text-primary'
                ],
                'attr' => [                            // Attributes for <input> tag
                    'class' => 'form-control',
                    'placeholder' => 'Enter your username',
                    'maxlength' => 100
                ],
                'required' => true,                    // Required field (adds * symbol and required HTML)
                'mapped' => true,                      // Link field to entity property
                'disabled' => false,                   // Disable the input
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',               
                'label_attr' => [                      
                    'class' => 'control-label text-primary'
                ],
                'attr' => [                            
                    'class' => 'form-control',
                    'placeholder' => 'Enter your password'
                ],
                'required' => true,                    
                'mapped' => true,                      
                'disabled' => false,                   
            ])
            ->add('fullName', TextType::class, [
                'label' => 'Fullname',               
                'label_attr' => [                      
                    'class' => 'control-label text-primary'
                ],
                'attr' => [                            
                    'class' => 'form-control',
                    'placeholder' => 'Enter your full name'
                ],
                'required' => true,                    
                'mapped' => true,                      
                'disabled' => false,     
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Phone Number',               
                'label_attr' => [                      
                    'class' => 'control-label text-primary'
                ],
                'attr' => [                            
                    'class' => 'form-control',
                    'placeholder' => 'Enter your phone number',
                    'maxlength' => 10
                ],
                'required' => true,                    
                'mapped' => true,                      
                'disabled' => false,                   
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',               
                'label_attr' => [                      
                    'class' => 'control-label text-primary'
                ],
                'attr' => [                            
                    'class' => 'form-control',
                    'placeholder' => 'Enter your email'
                ],
                'required' => true,                    
                'mapped' => true,                      
                'disabled' => false,                   
            ])
            ->add('city', TextType::class, [
                'label' => 'City',               
                'label_attr' => [                    
                    'class' => 'control-label text-primary'
                ],
                'attr' => [                           
                    'class' => 'form-control',
                    'placeholder' => 'Enter your city name.',
                    'maxlength' => 100
                ],
                'required' => true,                    
                'mapped' => true,                     
                'disabled' => false,                   
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
