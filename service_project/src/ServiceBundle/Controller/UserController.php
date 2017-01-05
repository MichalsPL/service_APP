<?php

    namespace ServiceBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use ServiceBundle\Entity\User;
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
         * @Route("/", name="userIndex")
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
         * @Route("/showOrder/{id}", name="userShowOrder")
         */
        public function showOrderAction($id) {
            $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $order = $repository->findOneById($id);

            if ($order->getMotorcycle()->getUserId()->getId() == $userId) {

                return $this->render('ServiceBundle:User:show_order.html.twig', array(
                            'order' => $order
                ));
            } else {
                return $this->redirectToRoute('userIndex', array());
            }
            return $this->render('ServiceBundle:User:show_action.html.twig', array(
                            // ...
            ));
        }

        /**
         * @Route("/changeUserDetails", name="userChangeUserDetails")
         */
        public function changeUserDetailsAction() {
            $user = $this->getUser();
            $form = createForm($user);
            $userManager = $container->get('fos_user.user_manager');
            return $this->render('ServiceBundle:User:change_user_details.html.twig', array(
                        'form' => $form->createView(),
                        'user' => $user
            ));
        }

    }
    