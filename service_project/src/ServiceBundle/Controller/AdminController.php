<?php

    namespace ServiceBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/admin")
     */
    class AdminController extends Controller {

        /**
         * @Route("/", name="admin_index")
         */
        public function adminIndexAction() {


            return $this->render('ServiceBundle:Admin:index.html.twig', array(
            ));
        }

        /**
         * @Route("/showAllEmployees", name="admin_show_all_employees")
         */
        public function managerShowAllEmployeesAction() {

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ServiceBundle:Employee');
            $admins = $repository->getAllAdmins();
            $mechanics = $repository->getAllMechanics();
            $managers = $repository->getAllManagers();

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

        /**
         * @Route("/changeStatus/{employeeId}", name="admin_change_status")
         */
        public function adminChangeStatusEmployeeAction($employeeId) {

            $employee = $this->getDoctrine()
                    ->getRepository('ServiceBundle:Employee')
                    ->findOneById($employeeId);
            $userManager = $this->container->get('fos_user.user_manager');
            if ($employee->isEnabled() == true) {
                $employee->setEnabled(false);
                $userManager->updateUser($employee, true);
            } else {
                $employee->setEnabled(true);
                $userManager->updateUser($employee, true);
            }

            return $this->redirectToRoute('admin_show_employee', array('employeeId' => $employeeId));
        }

        private function editEmployeeForm($employee) {
            $form = $this->createFormBuilder($employee)
                    ->setMethod('POST')
                    ->add('name')
                    ->add('surname')
                    ->add('email')
                    ->add('plainPassword', null, array(
                        'data' => '',
                        'required' => false
                    ))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $form;
        }

        /**
         * @Route("/changeEmployee/{employeeId}", name="admin_change_employee")
         * @Method({"GET"})
         */
        public function changeEmployeeDetailsFormAction($employeeId) {
            $employee = $this->getDoctrine()
                    ->getRepository('ServiceBundle:Employee')
                    ->findOneById($employeeId);

            $form = $this->editEmployeeForm($employee);

            return $this->render('ServiceBundle:Admin:change_employee_details.html.twig', array(
                        'form' => $form->createView(),
                        'message' => "wpisz nowe dane jeśli nie chcesz zmieniać hasła zostaw puste pole"
            ));
        }

        /**
         * @Route("/changeEmployee/{employeeId}")
         * @Method({"POST"})
         */
        public function changeUserDetailsAction(Request $request, $employeeId) {
            $employee = $this->getDoctrine()
                    ->getRepository('ServiceBundle:Employee')
                    ->findOneById($employeeId);

            $form = $this->editEmployeeForm($employee);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $userManager = $this->container->get('fos_user.user_manager');

                $editedEmployee = $employee;
                $editedEmployee = $form->getData();
                if ($editedEmployee->getPlainPassword() == "") {
                    $editedEmployee->setPlainPassword($employee->getPlainPassword());
                }

                $userManager->updateUser($editedEmployee, true);


                return $this->render('ServiceBundle:Admin:change_employee_details.html.twig', array(
                            'message' => 'zmieniłeś swoje dane ',
                            'home' => 'wróć'
                ));
            } else {
                // wymyśl co jak błąd
            }
        }

    }
    