<?php

    namespace ServiceBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use ServiceBundle\Entity\Motorcycle;
    use ServiceBundle\Entity\ServiceOrder;
    use ServiceBundle\Entity\Action;
    use ServiceBundle\Entity\Part;
    use ServiceBundle\Entity\User;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

    /**
     * @Route("/manager")
     */
    class ManagerController extends Controller {

        /**
         * @Route("/", name="manager_index")
         */
        public function managerIndexAction() {
            return $this->render('ServiceBundle:Manager:index.html.twig', array(
                            // ...
            ));
        }


        /**
         * @Route("/modifyUser")
         */
        public function modifyUserAction() {
            return $this->render('ServiceBundle:Manager:modify_user.html.twig', array(
                            // ...
            ));
        }
        
                /**
         * @Route("/showAllCustomers", name="manager_show_all_customers")
         */
        public function managerShowAllCustomersAction() {
            
            $customers = $this->getDoctrine()->getRepository('ServiceBundle:Customer')->findAll();
            return $this->render('ServiceBundle:Manager:customers_show_all.html.twig', array(
                            'customers'=>$customers
            ));
        }

                        /**
         * @Route("/showOneCustomer/{customerId}", name="manager_show_customer")
         */
        public function managerShowOneCustomerAction() {
            
            $customers = $this->getDoctrine()->getRepository('ServiceBundle:Customer')->findAll();
            return $this->render('ServiceBundle:Manager:customers_show_all.html.twig', array(
                            'customers'=>$customers
            ));
        }
    }
    