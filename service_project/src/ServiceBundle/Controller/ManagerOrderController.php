<?php

    namespace ServiceBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use ServiceBundle\Entity\Customer;
    use ServiceBundle\Entity\ServiceOrder;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/manager")
     */
    class ManagerOrderController extends Controller {

        /**
         * @Route("/chooseOrderUser", name="choose_user_for_order")
         * @Method({"GET"})
         */
        public function addServiceOrderUserAction() {
            $user = new Customer;
            $form = $this->createFormBuilder($user)
                    ->add('username', EntityType::class, array(
                        'class' => 'ServiceBundle:Customer',
                        'label' => 'Wybierz użytkownika',
                        'attr' => array('class' => 'form-control')
                    ))->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $this->render('ServiceBundle:Manager/ServiceOrder:add_service_order.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'user'
            ));
        }

        /**
         * @Route("/chooseOrderUser")
         * @Method({"POST"})
         */
        public function ChooseServiceOrderUserAction(Request $request) {
            $user = new Customer;
            $form = $this->createFormBuilder($user)
                    ->add('username', 'entity', array(
                        'class' => 'ServiceBundle:Customer',
                        'label' => 'Wybierz użytkownika',
                        'attr' => array('class' => 'form-control')
                    ))->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            $form->handleRequest($request);
            if ($form->isValid()) {
                $userId = $form->getData()->getUsername()->getId();

                return $this->redirectToRoute('choose_motorcycle_for_order', array(
                            'userId' => $userId
                ));
            } else {
                return $this->redirectToRoute('choose_user_for_order', array(
// przemyśl co ma zrobić jak błąd
                ));
            }
        }

        /**
         * @Route("/chooseOrderMotorcycle/{userId}", name="choose_motorcycle_for_order")
         * @Method({"GET"})
         */
        public function addServiceOrderMotorcycleAction($userId) {
            $serviceOrder = new ServiceOrder;
            $em = $this->getDoctrine()->getManager();
            $motorcycles = $em->getRepository('ServiceBundle:Motorcycle')->getCustomerMotorcycles($userId);
            $form = $this->createFormBuilder($serviceOrder)
                    ->add('motorcycle', ChoiceType::class, array(
                        'choices' =>
                        $motorcycles,
                        'choices_as_values' => true,
                        'choice_label' => 'regPlate',
                        'label' => 'Wybierz motocykl',
                        'attr' => array('class' => 'form-control')
                    ))->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $this->render('ServiceBundle:Manager/ServiceOrder:add_service_order.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'motorcycle',
                        'userId' => $userId
            ));
        }

        /**
         * @Route("/chooseOrderMotorcycle/{userId}")
         * @Method({"POST"})
         */
        public function ChooseServiceOrderMotorcycleAction(Request $request, $userId) {
            $serviceOrder = new ServiceOrder;
            $form = $this->createFormBuilder($serviceOrder)
                    ->add('motorcycle', ChoiceType::class, array(
                        'choices' =>
                        $this->getUserMotorcycles($userId),
                        'choices_as_values' => true,
                        'choice_label' => 'regPlate',
                        'label' => 'Wybierz motocykl',
                        'attr' => array('class' => 'form-control')
                    ))->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            $form->handleRequest($request);
            if ($form->isValid()) {
                $motorcycleId = $form->getData()->getMotorcycle()->getId();

                return $this->redirectToRoute('manager_add_service_order', array(
                            'motorcycleId' => $motorcycleId
                ));
            } else {
                return $this->redirectToRoute('addServiceOrder', array(
// przemyśl co ma zrobić jak błąd        
                ));
            }
        }

        private function createServiceOrderForm($serviceOrder) {
            $em = $this->getDoctrine()->getManager();
            $statuses = $em->getRepository('ServiceBundle:OrderStatus')->chooseStatusForAddOrder();       
            $mechanics = $em->getRepository('ServiceBundle:Employee')->getActiveMechanic();
            $managers = $em->getRepository('ServiceBundle:Employee')->getActiveManager();

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mileage', null, array('attr' => array('class' => 'form-control')))
                    ->add('manager', ChoiceType::class, array('choices_as_values' => true,
                        'choice_label' => 'name',
                        'label' => 'Wybierz Managera',
                        'choices' => $managers,
                        'attr' => array('class' => 'form-control')))
                    ->add('mechanic', ChoiceType::class, array('choices_as_values' => true,
                        'choice_label' => 'name',
                        'label' => 'Wybierz Mechanika',
                        'choices' => $mechanics,
                        'attr' => array('class' => 'form-control')))
                    ->add('startDate', DateTimeType::class, array(
                        'placeholder' => array(
                            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                            'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                        ), 'attr' => array('class' => 'form-control'),
                        'minutes' => range(0, 45, 15)
                    ))
                    ->add('endDate', DateTimeType::class, array(
                        'placeholder' => array(
                            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                            'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                        ), 'attr' => array('class' => 'form-control'),
                        'minutes' => range(0, 45, 15)
                    ))
                    ->add('dateOfAcceptance', DateTimeType::class, array(
                        'placeholder' => array(
                            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                            'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                        ), 'attr' => array('class' => 'form-control'),
                        'minutes' => range(0, 45, 15)
                    ))
                    ->add('dateOfRelase', DateTimeType::class, array(
                        'placeholder' => array(
                            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                            'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                        ), 'attr' => array('class' => 'form-control'),
                        'minutes' => range(0, 45, 15)
                    ))
                    ->add('orderStatus', ChoiceType::class, array('choices_as_values' => true,
                        'choice_label' => 'name',
                        'label' => 'Wybierz status',
                        'choices' => $statuses,
                        'attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $form;
        }

        /**
         * @Route("/addServiceOrder/{motorcycleId}", name="manager_add_service_order")
         * @Method({"GET"})
         */
        public function addServiceOrderFormAction($motorcycleId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $serviceOrder = new ServiceOrder;
            $serviceOrder->setMotorcycle($motorcycle);
            $serviceOrder->setMileage($motorcycle->getMileage());
            $form = $this->createServiceOrderForm($serviceOrder);


            return $this->render('ServiceBundle:Manager/ServiceOrder:add_service_order.html.twig', array(
                        'form' => $form->createView(),
            ));
        }

        /**
         * @Route("/addServiceOrder/{motorcycleId}")
         * @Method({"POST"})
         * 
         */
        public function addServiceOrderAction(Request $request, $motorcycleId) {
            $serviceOrder = new ServiceOrder;
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);
            $form = $this->createServiceOrderForm($serviceOrder);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setMotorcycle($motorcycle);
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                $id = $serviceOrder->getId();

                return $this->redirectToRoute('manager_add_action', array(
                            'orderId' => $id
                ));
            } else {
// wymyśl co jak błąd
            }
        }

        /**
         * @Route("/orderCheckout/{orderId}", name="order_checkout")
         * @Method({"GET"})
         * 
         */
        public function orderCheckoutFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatus()->getId());
            $serviceOrder->setOrderStatus($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Action');
            $serviceActions = $repository->findByServiceOrder($orderId);
            $em = $this->getDoctrine()->getManager();
            $actionsSum = $em->getRepository('ServiceBundle:Action')->getActionsTotal($serviceActions);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Part');
            $serviceParts = $repository->findByServiceOrder($orderId);
            $em = $this->getDoctrine()->getManager();
            $partsSum = $em->getRepository('ServiceBundle:Part')->getPartsTotal($serviceParts);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('ManagerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/ServiceOrder:service_order_checkout.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'actions' => $serviceActions,
                        'actionsSum' => $actionsSum,
                        'parts' => $serviceParts,
                        'partsSum' => $partsSum,
                        'finalPrice' => $partsSum + $actionsSum,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderCheckout/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function orderCheckoutAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('ManagerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                $message = "dodałeś nowe zlecenie";
            } else {

                $message = "zlecenie  nie zostało dodane";
            }

            return $this->render('ServiceBundle:Manager/ServiceOrder:service_order_checkout_final.html.twig', array(
                        'message' => $message
            ));
        }

        /**
         * @Route("/modifyServiceOrder/{orderId}", name="manager_modify_service_order")
         * @Method({"GET"})
         */
        public function modifyServiceOrderFormAction($orderId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $form = $this->createServiceOrderForm($serviceOrder);


            return $this->render('ServiceBundle:Manager/ServiceOrder:add_service_order.html.twig', array(
                        'form' => $form->createView(),
            ));
        }

        /**
         * @Route("/modifyServiceOrder/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function modifyServiceOrderAction(Request $request, $orderId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $form = $this->createServiceOrderForm($serviceOrder);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                $id = $serviceOrder->getId();

                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $id
                ));
            } else {
// wymyśl co jak błąd
            }
        }

        /**
         * @Route("/show_all_orders", name="manager_show_all_orders")
         */
        public function showAllOrdersAction() {

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT s FROM ServiceBundle:ServiceOrder s ORDER BY s.id');
            $allOrders = $query->getResult();
            $orders = [];
            foreach ($allOrders as $order) {
                $orderName = $order->getOrderStatus()->getName();
                $order->setOrderStatus($orderName);
                $orders[] = $order;
            }
            $message = "widzisz wszystkie zlecenia";
            return $this->render('ServiceBundle:Manager/ServiceOrder:show_orders.html.twig', array(
                        'orders' => $orders,
                        'message' => $message,
            ));
        }

        /**
         * @Route("/show_orders_by_status/{statusId}", name="manager_show_orders_by_status")
         */
        public function showOrdersByStatusAction($statusId) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT s FROM ServiceBundle:ServiceOrder s WHERE s.orderStatus = '
                    . $statusId . 'ORDER BY s.id');
            $allOrders = $query->getResult();
            $orders = [];
            foreach ($allOrders as $order) {
                $orderName = $order->getOrderStatus()->getName();
                $order->setOrderStatus($orderName);
                $orders[] = $order;
            }

            return $this->render('ServiceBundle:Manager/ServiceOrder:show_orders.html.twig', array(
                        'orders' => $orders,
                        'message' => "Widzisz zlecenia o wybranym statusie"
            ));
        }

        /**
         * @Route("/showOneOrder/{orderId}", name="manager_show_one_order")
         * @Method({"GET"})
         * 
         */
        public function orderDisplayFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Action');
            $serviceActions = $repository->findByServiceOrder($orderId);
            $actionsSum = $this->getActionTotal($serviceActions);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Part');
            $serviceParts = $repository->findByServiceOrder($orderId);
            $partsSum = $this->getPartsTotal($serviceParts);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('ManagerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/ServiceOrder:service_order_checkout.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'actions' => $serviceActions,
                        'actionsSum' => $actionsSum,
                        'parts' => $serviceParts,
                        'partsSum' => $partsSum,
                        'finalPrice' => $partsSum + $actionsSum,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/showOneOrder/{orderId}", name="manager_show_one_order")
         * @Method({"POST"})
         * 
         */
        public function orderDisplayAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('ManagerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                $message = "dodałeś nowe zlecenie";
            } else {

                $message = "zlecenie  nie zostało dodane";
            }

            return $this->render('ServiceBundle/ServiceOrder:Manager:service_order_checkout_final.html.twig', array(
                        'message' => $message
            ));
        }

    }
    