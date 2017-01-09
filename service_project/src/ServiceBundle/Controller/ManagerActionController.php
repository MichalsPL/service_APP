<?php

    namespace ServiceBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use ServiceBundle\Entity\Action;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/manager")
     */
    class ManagerActionController extends Controller {

        public function TotalActionPrice($actions) {
            $price = 0;
            foreach ($actions as $action) {
                $price += $action->getPrice();
            }
            return $price;
        }

        public function createActionForm($action) {

            $form = $this->createFormBuilder($action)
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
            $form = $this->createActionForm($serviceAction);

            return $this->render('ServiceBundle:Manager:add_service_action.html.twig', array(
                        'form' => $form->createView(),
                        'orderId' => $orderId
            ));
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
            $form = $this->createActionForm($serviceAction);
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

        /**
         * @Route("/editServiceAction/{actionId}", name="manager_edit_action")
         * @Method({"GET"})
         * 
         */
        public function editServiceActionFormAction($actionId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Action');
            $serviceAction = $repository->findOneById($actionId);
            $form = $this->createActionForm($serviceAction);
            $actionId = $serviceAction->getServiceOrder()->getId();

            return $this->render('ServiceBundle:Manager:add_service_action.html.twig', array(
                        'form' => $form->createView(),
                        'actionId' => $actionId,
                        'orderId' => $orderId
            ));
        }

        /**
         * @Route("/editServiceAction/{actionId}")
         * @Method({"POST"})
         * 
         */
        public function editServiceActionAction(Request $request, $actionId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Action');
            $serviceAction = $repository->findOneById($actionId);

            $form = $this->createActionForm($serviceAction);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $serviceAction = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceAction);
                $em->flush();


                $message = "Dodałeś nową czynność";
            } else {

                $message = "Czynność nie została dodana";
            }
            return $this->redirectToRoute('order_checkout', array(
                        'orderId' => $serviceAction->getServiceOrder()->getId()
            ));
        }

        /**
         * @Route("/deleteServiceAction/{actionId}", name="manager_delete_action")
         * @Method({"GET"})
         * 
         */
        public function deleteServiceActionAction($actionId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Action');
            $serviceAction = $repository->findOneById($actionId);
            $em = $this->getDoctrine()->getManager();
            $deleted = $serviceAction;
            $em->remove($serviceAction);
            $em->flush();

            return $this->redirectToRoute('order_checkout', array(
                        'orderId' => $deleted->getServiceOrder()->getId()
            ));
        }

    }
    