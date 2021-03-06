<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => false, 'attr' => array(
                'placeholder' => 'Votre email ...',
                'class' => 'form-control'
            )))
            ->add('username', TextType::class, array('label' => false,'attr' => array(
                'placeholder' => 'Identifiant ...',
                'class' => 'form-control'
            )))
            ->add('password', PasswordType::class, array('label' => false,'attr' => array(
                'placeholder' => 'Mot de passe ...',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}