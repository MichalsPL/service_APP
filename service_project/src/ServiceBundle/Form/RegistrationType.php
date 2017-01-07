<?php
// src/AppBundle/Form/RegistrationType.php

namespace ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use ServiceBundle\Entity\User;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user= new User();
        $builder->add('name');
        $builder->add('surname');
        $builder->add('phoneNo');
        $builder->add('roles' ,'choice' ,array('choices'=>$user->getRoles())) ;
    }

    public function getParent()
    {
        return 'ServiceBundle\Form\Type\RegistrationFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }


    public function getName()
    {
        return $this->getBlockPrefix();
    }
}