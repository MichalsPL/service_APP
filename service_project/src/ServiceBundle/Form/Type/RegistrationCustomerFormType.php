<?php



    namespace ServiceBundle\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use ServiceBundle\Entity\Customer;

    class RegistrationCustomerFormType extends AbstractType {

        public function buildForm(FormBuilderInterface $builder, array $options) {
            $user = new Customer();
            $builder->add('name', null,
            array('label' => 'Imię',
                   'attr' => array('class' => 'form-control')));
            $builder->add('surname', null,
            array('label' => 'Nazwisko',
                   'attr' => array('class' => 'form-control')));
            $builder->add('phoneNo', null,
            array('label' => 'Numer telefonu',
                   'attr' => array('class' => 'form-control')));
           
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
    