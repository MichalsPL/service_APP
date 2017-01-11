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

        private function createActionForm($action) {

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

            return $this->render('ServiceBundle:Manager/Action:add_service_action.html.twig', array(
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
            $actions = $repository->findByServiceOrderId($serviceOrder);

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

                $em = $this->getDoctrine()->getManager();
                $price = $em->getRepository('ServiceBundle:Action')
                        ->getActionsTotal($actions);
                $serviceAction = new Action;
                $form = $this->createActionForm($serviceAction, $orderId);

                $message = "Dodałeś nową czynność";
            } else {

                $message = "Czynność nie została dodana";
            }

            return $this->render('ServiceBundle:Manager/Action:add_service_action.html.twig', array(
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

            return $this->render('ServiceBundle:Manager/Action:add_service_action.html.twig', array(
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
 return $this->redirectToRoute('order_checkout', array(
                        'orderId' => $serviceAction->getServiceOrder()->getId()
            ));

            } else {
// co jak błąd
            }
           
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

        /**
         * @Route("/editServicePart/{partId}", name="manager_edit_part")
         * @Method({"GET"})
         * 
         */
        public function editPartActionFormAction($partId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Part');
            $servicePart = $repository->findOneById($partId);
            $form = $this->createPartForm($servicePart);
            $orderId = $servicePart->getServiceOrder()->getId();

            return $this->render('ServiceBundle:Manager/Action:add_service_part.html.twig', array(
                        'form' => $form->createView(),
                        'partId' => $partId,
                        'orderId' => $orderId
            ));
        }

        /**
         * @Route("/editServicePart/{partId}")
         * @Method({"POST"})
         * 
         */
        public function editServicePartAction(Request $request, $partId) {

            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Part');
            $servicePart = $repository->findOneById($partId);

            $form = $this->createPartForm($servicePart);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $servicePart = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($servicePart);
                $em->flush();

     return $this->redirectToRoute('order_checkout', array(
                        'orderId' => $servicePart->getServiceOrder()->getId()
            ));
            } else {
// co jak błąd
            }
       
        }

        /**
         * @Route("/deleteServicePart/{partId}", name="manager_delete_part")
         * @Method({"GET"})
         * 
         */
        public function deleteServicePartAction($partId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Part');
            $servicePart = $repository->findOneById($partId);
            $em = $this->getDoctrine()->getManager();
            $deleted = $servicePart;
            $em->remove($servicePart);
            $em->flush();

            return $this->redirectToRoute('order_checkout', array(
                        'orderId' => $deleted->getServiceOrder()->getId()
            ));
        }

    }
    