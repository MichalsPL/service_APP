<?php

    namespace ServiceBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    /**
     * @Route("/admin")
     */
    class AdminController extends Controller {

        /**
         * @Route("/", name="admin_index")
         */
        public function managerIndexAction() {
            return $this->render('ServiceBundle:Admin:index.html.twig', array(
                            // ...
            ));
        }

        /**
         * @Route("/showAllEmployees", name="admin_show_all_employees")
         */
        public function managerShowAllEmployeesAction() {

            $admins = $this->getDoctrine()->getRepository('ServiceBundle:Employee')
                    ->createQueryBuilder('e')
                    ->where('e.roles LIKE :role')
                    ->setParameter('role', '%ROLE_ADMIN%')
                    ->getQuery()
                    ->getResult();

            $mechanics = $this->getDoctrine()->getRepository('ServiceBundle:Employee')
                    ->createQueryBuilder('e')
                    ->where('e.roles LIKE :role')
                    ->setParameter('role', '%ROLE_MECHANIC%')
                    ->getQuery()
                    ->getResult();

            $managers = $this->getDoctrine()->getRepository('ServiceBundle:Employee')
                    ->createQueryBuilder('e')
                    ->where('e.roles LIKE :role')
                    ->setParameter('role', '%ROLE_MANAGER%')
                    ->getQuery()
                    ->getResult();

            return $this->render('ServiceBundle:Admin:admin_show_all_employees.html.twig', array(
                        'admins' => $admins,
                        'mechanics' => $mechanics,
                        'managers' => $managers
            ));
        }

        /**
         * @Route("/showOneEmployee/{employeeId}", name="admin_show_employee")
         */
        public function adminShowOneEmployeeAction($employeeId) {
  
            $employee = $this->getDoctrine()
                    ->getRepository('ServiceBundle:Employee')
                    ->findOneById($employeeId);

            return $this->render('ServiceBundle:Admin:employees_show_one.html.twig', array(
                        'employee' => $employee
                        
            ));
        }

    }
    