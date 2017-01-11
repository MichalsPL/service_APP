<?php

    namespace ServiceBundle\Controller;

    use DateTime;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/manager")
     */
    class ManagerStatusController extends Controller {

        /**
         * @Route("/orderAccept/{orderId}", name="manager_order_accept")
         * @Method({"GET"})
         * 
         */
        public function orderAcceptFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatusId()->getId());
            $serviceOrder->setOrderStatusId($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mileage', null, array('attr' => array('class' => 'form-control')))
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('ManagerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/OrderStatus:service_order_change_status_accept.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderAccept/{orderId}", name="manager_order_checkout")
         * @Method({"POST"})
         * 
         */
        public function orderAcceptAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById(3);
            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mileage', null, array('attr' => array('class' => 'form-control')))
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setOrderStatusId($orderStatus);
                $serviceOrder->setStartDate(new DateTime());
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $orderId
                ));
            } else {

                $message = "zlecenie  nie zostało dodane";
            }

            return $this->render('ServiceBundle:Manager/ServiceOrder:service_order_checkout_final.html.twig', array(
                        'message' => $message
            ));
        }

        /**
         * @Route("/orderOpen/{orderId}", name="manager_order_open")
         * @Method({"GET"})
         * 
         */
        public function orderOpenFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatus()->getId());
            $serviceOrder->setOrderStatusId($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mileage', null, array('attr' => array('class' => 'form-control')))
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/OrderStatus:service_order_change_status_accept.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderOpen/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function orderOpenAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById(3);
            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mileage', null, array('attr' => array('class' => 'form-control')))
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setOrderStatusId($orderStatus);
                $serviceOrder->setStartDate(new DateTime());
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $orderId
                ));
            } else {
                // co jak błąd              
            }
        }

        /**
         * @Route("/orderWaiting/{orderId}", name="manager_order_waiting")
         * @Method({"GET"})
         * 
         */
        public function orderWaitingFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatus()->getId());
            $serviceOrder->setOrderStatusId($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/OrderStatus:service_order_change_status_accept.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderWaiting/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function orderWaitingAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById(4);
            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setOrderStatusId($orderStatus);
                $serviceOrder->setStartDate(new DateTime());
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $orderId
                ));
            } else {
                // co jak błąd
            }
        }

        /**
         * @Route("/orderReady/{orderId}", name="manager_order_ready")
         * @Method({"GET"})
         * 
         */
        public function orderReadyFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatus()->getId());
            $serviceOrder->setOrderStatusId($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/OrderStstus:service_order_change_status_accept.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderReady/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function orderReadyAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById(5);
            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setOrderStatusId($orderStatus);
                $serviceOrder->setStartDate(new DateTime());
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $orderId
                ));
            } else {
                // co jak błąd              
            }
        }

        /**
         * @Route("/orderReadyCollect/{orderId}", name="manager_order_ready_collect")
         * @Method({"GET"})
         * 
         */
        public function orderReadyCollectFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatus()->getId());
            $serviceOrder->setOrderStatusId($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/OrderStatus:service_order_change_status_accept.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderReadyCollect/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function orderReadyCollectAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById(6);
            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setOrderStatusId($orderStatus);
                $serviceOrder->setStartDate(new DateTime());
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $orderId
                ));
            } else {
                // co jak błąd
            }
        }

        /**
         * @Route("/orderEnd/{orderId}", name="manager_order_end")
         * @Method({"GET"})
         * 
         */
        public function orderEndFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatus()->getId());
            $serviceOrder->setOrderStatusId($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/OrderStatus:service_order_change_status_accept.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderEnd/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function orderEndAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById(7);
            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setOrderStatusId($orderStatus);
                $serviceOrder->setStartDate(new DateTime());
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $orderId
                ));
            } else {
                // co jak błąd
            }
        }

        /**
         * @Route("/orderCancell/{orderId}", name="manager_order_cancell")
         * @Method({"GET"})
         * 
         */
        public function orderCancellFormAction($orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById($serviceOrder->getOrderStatus()->getId());
            $serviceOrder->setOrderStatusId($orderStatus);

            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('userComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();

            return $this->render('ServiceBundle:Manager/OrderStatus:service_order_change_status_accept.html.twig', array(
                        'order' => $serviceOrder,
                        'motorcycle' => $motorcycle,
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/orderCancell/{orderId}")
         * @Method({"POST"})
         * 
         */
        public function orderCancellAction(Request $request, $orderId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:ServiceOrder');
            $serviceOrder = $repository->findOneById($orderId);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:OrderStatus');
            $orderStatus = $repository->findOneById(8);
            $motorcycleId = $serviceOrder->getMotorcycle()->getId();
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);

            $form = $this->createFormBuilder($serviceOrder)
                    ->add('mechanicComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('managerComments', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceOrder = $form->getData();
                $serviceOrder->setOrderStatusId($orderStatus);
                $serviceOrder->setStartDate(new DateTime());
                $motorcycle->setMileage($serviceOrder->getMileage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirectToRoute('order_checkout', array(
                            'orderId' => $orderId
                ));
            } else {
                // co jak błąd 
            }
        }

    }
    