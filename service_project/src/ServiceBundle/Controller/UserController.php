<?php

    namespace ServiceBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use ServiceBundle\Entity\User;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/user")
     */
    class UserController extends Controller {

        public function getUserMotorcycles() {
            $userId = $this->container->get('security.context')->getToken()->getUser()->getId();

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycles = $repository->findByUserId($userId);

            return $motorcycles;
        }

        public function getUserOrders() {

            $orders = [];
            $motorcycles = $this->getUserMotorcycles();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            foreach ($motorcycles as $motorcycle) {
                $motorcycleId = $motorcycle->getId();
                $motorcycleOrders = $repository->findByMotorcycle($motorcycleId);
                foreach ($motorcycleOrders as $order) {
                    $orders[] = $order;
                }
            }

            return $orders;
        }

        public function getMotorcycleOrders($motorcycle) {

            $orders = [];
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $motorcycleId = $motorcycle->getId();
            $motorcycleOrders = $repository->findByMotorcycle($motorcycleId);
            foreach ($motorcycleOrders as $order) {
                $orders[] = $order;
            }
            return $orders;
        }

        /**
         * @Route("/", name="user_index")
         */
        public function indexAction() {

            $userMotorcycles = $this->getUserMotorcycles();
            $userOrders = $this->getUserOrders();

            return $this->render('ServiceBundle:User:index.html.twig', array(
                        'user_motorcycles' => $userMotorcycles,
                        'user_orders' => $userOrders
            ));
        }

        /**
         * @Route("/showMotorcycle/{id}", name="userShowMotorcycle")
         */
        public function showMotorcycleAction($id) {

            $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($id);

            $orders = $this->getMotorcycleOrders($motorcycle);

            if ($motorcycle->getUserId()->getId() == $userId) {

                return $this->render('ServiceBundle:User:show_motorcycle.html.twig', array(
                            'motorcycle' => $motorcycle,
                            'orders' => $orders
                ));
            } else {
                return $this->redirectToRoute('userIndex', array());
            }
        }

        /**
         * @Route("/showOrder/{orderId}", name="userShowOrder")
         */
        public function showOrderAction($orderId) {
            $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $order = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Action');
            $serviceActions = $repository->findByServiceOrder($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Part');
            $serviceParts = $repository->findByServiceOrder($orderId);

            if ($order->getMotorcycle()->getUserId()->getId() == $userId) {

                return $this->render('ServiceBundle:User:show_order.html.twig', array(
                            'order' => $serviceOrder,
                            'actions' => $serviceActions,
                            'parts' => $serviceParts
                ));
            } else {
                return $this->redirectToRoute('userIndex', array());
            }
        }

        public function editUserForm($user) {
            $form = $this->createFormBuilder($user)
                    ->add('name')
                    ->add('surname')
                    ->add('email')
                    ->add('postalCode')
                    ->add('city')
                    ->add('street')
                    ->add('houseNo')
                    ->add('aptNo')
                    ->add('password', null, array(
                        'data' => '',
                        'required' => false
                    ))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $form;
        }

        /**
         * @Route("/changeUserDetails", name="userChangeUserDetails")
         * @Method({"GET"})
         */
        public function changeUserDetailsFormAction() {
            $user = $this->getUser();

            $form = $this->editUserForm($user);

            return $this->render('ServiceBundle:User:change_user_details.html.twig', array(
                        'form' => $form->createView(),
                        'message' => "wpisz nowe dane jeśli nie chcesz zmieniać hasła zostaw puste pole"
            ));
        }

        /**
         * @Route("/changeUserDetails")
         * @Method({"POST"})
         */
        public function changeUserDetailsAction(Request $request) {
            $user = $this->getUser();

            $form = $this->createFormBuilder($user)
                    ->add('name')
                    ->add('surname')
                    ->add('email')
                    ->add('password', null, array(
                        'data' => '',
                        'required' => false
                    ))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $userManager = $this->container->get('fos_user.user_manager');

                $editedUser = $user;
                $editedUser = $form->getData();
                if ($editedUser->getPlainPassword() == "") {
                    $editedUser->setPlainPassword($user->getPlainPassword());
                }
                $userManager->updateUser($user, true);


                return $this->render('ServiceBundle:User:change_user_details.html.twig', array(
                            'message' => 'zmieniłeś swoje dane ',
                            'home' => 'wróć'
                ));
            } else {
                
            }
        }

    }
    