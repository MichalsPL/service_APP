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
    use ServiceBundle\Entity\Customer;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            return $this->render('ServiceBundle:Manager:add_service_order.html.twig', array(
                        'form' => $form->createView()
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

        public function getUserMotorcycles($userId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycles = $repository->findByUserId($userId);
            $choices = [];
            foreach ($motorcycles as $motorcycle) {
                $choices[] = [$motorcycle->getRegPlate() => $motorcycle->getId()];
            }
            return $motorcycles;
        }

        /**
         * @Route("/chooseOrderMotorcycle/{userId}", name="choose_motorcycle_for_order")
         * @Method({"GET"})
         */
        public function addServiceOrderMotorcycleAction($userId) {
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
            return $this->render('ServiceBundle:Manager:add_service_order.html.twig', array(
                        'form' => $form->createView()
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

                return $this->redirectToRoute('addServiceOrder', array(
                            'motorcycleId' => $motorcycleId
                ));
            } else {
                return $this->redirectToRoute('addServiceOrder', array(
// przemyśl co ma zrobić jak błąd        
                ));
            }
        }

        public function chooseStatus() {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $statuses = $repository->findAll();
            $choices = [];
            for ($i = 1; $i < 4; $i++) {
                $choices[] = $repository->findOneById($i);
            }

            return $choices;
        }

        public function createServiceOrderForm($serviceOrder) {
            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mileage', null, array('attr' => array('class' => 'form-control')))
                    ->add('manager', null, array('attr' => array('class' => 'form-control')))
                    ->add('mechanic', null, array('attr' => array('class' => 'form-control')))
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
                        'choices' => $this->chooseStatus(),
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


            return $this->render('ServiceBundle:Manager:add_service_order.html.twig', array(
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
         * @Route("/checkoutOrder/{orderId}", name="manager_order_checkout")
         * 
         * @Method({"GET"})
         */
        public function checkoutServiceOrderAction($orderId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $order = $repository->findOneById($orderId);
            $form = $this->createFormBuilder($order)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('ManagerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager:modify_service_order.html.twig', array(
                        'form' => $form->createView(),
                        'order' => $order
            ));
        }

        /**
         * @Route("/modifyOrderAction/order")
         */
        public function modifyServiceOrderAction() {
            return $this->render('ServiceBundle:Manager:modify_service_order.html.twig', array(
                            // ...
            ));
        }

        public function createActionForm($action, $orderId) {

            $form = $this->createFormBuilder($action)
                    ->add('serviceOrder', HiddenType::class, array(
                        'data' => $orderId,
                    ))
                    ->add('name', null, array('attr' => array('class' => 'form-control')))
                    ->add('price', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $form;
        }

        /**
         * @Route("/addServiceAction/{orderId}", name="manager_add_action")
         * @Method({"GET"})
         * 
         */
        public function addServiceActionFormAction($orderId) {
            $serviceAction = new Action;
            $form = $this->createActionForm($serviceAction, $orderId);

            return $this->render('ServiceBundle:Manager:add_service_action.html.twig', array(
                        'form' => $form->createView(),
                        'orderId' => $orderId
            ));
        }

        public function TotalActionPrice($actions) {
            $price = 0;
            foreach ($actions as $action) {
                $price += $action->getPrice();
            }
            return $price;
        }

        /**
         * @Route("/addServiceAction/{orderId}", name="add_next_action")
         * @Method({"POST"})
         * 
         */
        public function addServiceActionAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Action');
            $actions = $repository->findByServiceOrder($serviceOrder);

            $serviceAction = new Action;
            $form = $this->createActionForm($serviceAction, $orderId);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceAction = $form->getData();
                $serviceAction->setServiceOrder($serviceOrder);
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceAction);
                $em->flush();
                $actions[] = $serviceAction;
                $price = $this->TotalActionPrice($actions);
                $serviceAction = new Action;
                $form = $this->createActionForm($serviceAction, $orderId);

                $message = "Dodałeś nową czynność";
            } else {

                $message = "Czynność nie została dodana";
            }

            return $this->render('ServiceBundle:Manager:add_service_action.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message,
                        'orderId' => $orderId,
                        'actions' => $actions,
                        'price' => $price
            ));
        }

        public function createPartForm($action, $orderId) {

            $form = $this->createFormBuilder($action)
                    ->add('serviceOrder', HiddenType::class, array(
                        'data' => $orderId,
                    ))
                    ->add('name', null, array('attr' => array('class' => 'form-control'),
                        'label' => 'Podaj nazwę części'))
                    ->add('quantity', null, array('attr' => array('class' => 'form-control'),
                        'label' => 'podaj ilość użytą do naprawy'))
                    ->add('price', null, array('attr' => array('class' => 'form-control'),
                        'label' => 'Podaj cenę za wszystkie jednostki'))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $form;
        }

        public function TotalPartsPrice($parts) {
            $price = 0;
            foreach ($parts as $part) {
                $price += $part->getPrice();
            }
            return $price;
        }

        /**
         * @Route("/addPart/{orderId}", name="add_part")
         * @Method({"GET"})
         * 
         */
        public function addPartFormAction($orderId) {
            $part = new Part;
            $form = $this->createPartForm($part, $orderId);

            return $this->render('ServiceBundle:Manager:add_service_part.html.twig', array(
                        'form' => $form->createView(),
                        'orderId' => $orderId,
            ));
        }

        /**
         * @Route("/addPart/{orderId}", name="add_next_part")
         * @Method({"POST"})
         * 
         */
        public function addPartAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Part');
            $parts = $repository->findByServiceOrder($serviceOrder);

            $part = new Part;
            $form = $this->createPartForm($part, $orderId);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $part = $form->getData();
                $part->setServiceOrder($serviceOrder);
                $em = $this->getDoctrine()->getManager();
                $em->persist($part);
                $em->flush();
                $parts[] = $part;
                $price = $this->TotalPartsPrice($parts);
                $part = new Part;
                $form = $this->createPartForm($part, $orderId);
                $message = "dodałeś nowe zlecenie";
            } else {

                $message = "zlecenie  nie zostało dodane";
            }

            return $this->render('ServiceBundle:Manager:add_service_part.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message,
                        'orderId' => $orderId,
                        'parts' => $parts,
                        'price' => $price
            ));
        }

        public function getActionTotal($actions) {
            $sum = 0;
            foreach ($actions as $action) {
                $sum += $action->getPrice();
            }
            return $sum;
        }

        public function getPartsTotal($parts) {
            $sum = 0;
            foreach ($parts as $part) {
                $sum += $part->getPrice();
            }
            return $sum;
        }

        /**
         * @Route("/orderCheckout/{orderId}", name="order_checkout")
         * @Method({"GET"})
         * 
         */
        public function orderCheckoutFormAction($orderId) {

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

            return $this->render('ServiceBundle:Manager:service_order_checkout.html.twig', array(
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

            return $this->render('ServiceBundle:Manager:service_order_checkout_final.html.twig', array(
                        'message' => $message
            ));
        }

        /**
         * @Route("/show_all_orders")
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
            return $this->render('ServiceBundle:Manager:show_orders.html.twig', array(
                        'orders' => $orders,
                        'message' => $message,
                        'status' => $order
            ));
        }

        /**
         * @Route("/show_orders_by_status/{statusId}")
         */
        public function showOrdersByStatusAction($statusId) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT s FROM ServiceBundle:ServiceOrder s WHERE s.orderStatus = ' . $statusId . 'ORDER BY s.id');
            $orders = $query->getResult();

            return $this->render('ServiceBundle:Manager:test.html.twig', array(
                        'orders' => $orders
            ));
        }

    }
    