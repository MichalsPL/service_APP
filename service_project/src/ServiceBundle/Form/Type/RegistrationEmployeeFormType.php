<?php

    namespace ServiceBundle\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use ServiceBundle\Entity\Employee;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\CollectionType;

    class RegistrationEmployeeFormType extends AbstractType {

        public function buildForm(FormBuilderInterface $builder, array $options) {
            $user = new Employee();
            $builder->add('name');
            $builder->add('surname');
            $builder->add('phoneNo');

            $builder->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Admin' => 'ROLE_ADMIN',
                    'Mechanic' => 'ROLE_MECHANIC',
                    'Manager' => 'ROLE_MANAGER',
                ),
            ));


            $builder->add('roles', CollectionType::class, array(
                'label' => 'rola',
                // each entry in the array will be an "email" field
                'entry_type' => ChoiceType::class,
                // these options are passed to each "email" type
                'entry_options' => array(
                    'choices' => array(
                        'Admin' => 'ROLE_ADMIN',
                        'Mechanic' => 'ROLE_MECHANIC',
                        'Manager' => 'ROLE_MANAGER',
                    ),
                    'choices_as_values' => true
            )));
        }

        public function getParent() {
            return 'ServiceBundle\Form\Type\RegistrationFormType';
        }

        public function getBlockPrefix() {
            return 'app_user_registration';
        }

        public function getName() {
            return $this->getBlockPrefix();
        }

    }
    