<?php

    namespace ServiceBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use ServiceBundle\Entity\Part;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/manager")
     */
    class ManagerPartController extends Controller {

        public function createPartForm($action) {

            $form = $this->createFormBuilder($action)
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

        /**
         * @Route("/addPart/{orderId}", name="add_part")
         * @Method({"GET"})
         * 
         */
        public function addPartFormAction($orderId) {
            $part = new Part;
            $form = $this->createPartForm($part);

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
            $form = $this->createPartForm($part);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $part = $form->getData();
                $part->setServiceOrder($serviceOrder);
                $em = $this->getDoctrine()->getManager();
                $em->persist($part);
                $em->flush();
                $parts[] = $part;
                $em = $this->getDoctrine()->getManager();
                $price = $em->getRepository('ServiceBundle:Part')
                        ->getPartsTotal($parts);
                $part = new Part;
                $form = $this->createPartForm($part);
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

    }
    