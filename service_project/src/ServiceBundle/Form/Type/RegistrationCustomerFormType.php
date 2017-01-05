<?php
// src/AppBundle/Form/RegistrationType.php

namespace ServiceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use ServiceBundle\Entity\Customer;

class RegistrationCustomerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user= new Customer();
        $builder->add('name');
        $builder->add('surname');
        $builder->add('phoneNo');

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

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