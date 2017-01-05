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
    class ManagerMotorcycleController extends Controller {

        public function createMotorcycleForm($motorcycle) {

            $form = $this->createFormBuilder($motorcycle)
                    ->add('type', null, array('attr' => array('class' => 'form-control')))
                    ->add('make', null, array('attr' => array('class' => 'form-control')))
                    ->add('model', null, array('attr' => array('class' => 'form-control')))
                    ->add('capacity', null, array('attr' => array('class' => 'form-control')))
                    ->add('regPlate', null, array('attr' => array('class' => 'form-control')))
                    ->add('vin', null, array('attr' => array('class' => 'form-control')))
                    ->add('year', null, array('attr' => array('class' => 'form-control')))
                    ->add('mileage', null, array('attr' => array('class' => 'form-control')))
                    ->add('status', null, array('attr' => array('class' => 'form-control')))
                    ->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $form;
        }

        /**
         * @Route("/addMotorcycle", name="choose_user_for_motorcycle")
         * @Method({"GET"})
         */
        public function chooseUserForMotorcycleFormAction() {
            $user = new Customer();
            $form = $this->createFormBuilder($user)
                    ->add('username', EntityType::class, array(
                        'class' => 'ServiceBundle:Customer',
                        'label' => 'Wybierz użytkownika',
                        'attr' => array('class' => 'form-control')
                    ))->add('save', 'submit', array('label' => 'zatwierdź'))
                    ->getForm();
            return $this->render('ServiceBundle:Manager/Motorcycle:add_motorcycle.html.twig', array(
                        'form' => $form->createView(),
                        'message' => 'Wybierz właściciela motocykla'
            ));
        }

        /**
         * @Route("/addMotorcycle")
         * @Method({"POST"})
         */
        public function ChooseUserForMotorcycleAction(Request $request) {
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


                return $this->redirectToRoute('add_motorcycle', array(
                            'userId' => $userId
                ));
            } else {
                return $this->redirectToRoute('choose_user_for_order', array(
// przemyśl co ma zrobić jak błąd
                ));
            }
        }

        /**
         * @Route("/addMotorcycle/{userId}", name="add_motorcycle")
         * @Method({"GET"})
         */
        public function addMotorcycleFormAction($userId) {
            $motorcycle = new Motorcycle;
            $form = $this->createMotorcycleForm($motorcycle);
            return $this->render('ServiceBundle:Manager/Motorcycle:add_motorcycle.html.twig', array(
                        'message' => 'dodajesz nowy motocykl',
                        'form' => $form->createView()
            ));
        }

        /**
         * @Route("/addMotorcycle/{userId}")
         * @Method({"POST"})
         */
        public function addMotorcycleAction(Request $request, $userId) {
            $motorcycle = new Motorcycle;
            $form = $this->createMotorcycleForm($motorcycle);
            $form->handleRequest($request);
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Customer');
            $user = $repository->findOneById($userId);
            if ($form->isValid()) {
                $motorcycle = $form->getData();
                $motorcycle->setUserId($user);
                $em = $this->getDoctrine()->getManager();
                $em->persist($motorcycle);
                $em->flush();
                $message = "dodałeś nowy motocykl";
            } else {
                $message = "motocykl nie został dodany";
            }
            return $this->render('ServiceBundle:Manager/Motorcycle:show_motorcycle.html.twig', array(
                        'message' => $message,
                        'motorcycle' => $motorcycle
            ));
        }

        /**
         * @Route("/modifyMotorcycle/{motorcycleId}", requirements={"id": "\d+"}, name="manager_modify_motorcycle")
         * @Method({"GET"})
         */
        public function modifyMotorcycleFormAction($motorcycleId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);
            $form = $this->createMotorcycleForm($motorcycle);
            return $this->render('ServiceBundle:Manager/Motorcycle:add_motorcycle.html.twig', array(
                        'form' => $form->createView(),
                        'message' => 'edytujesz motocykl'
            ));
        }

        /**
         * @Route("/modifyMotorcycle/{motorcycleId}", requirements={"motorcycleId": "\d+"})
         * @Method({"POST"})
         */
        public function modifyMotorcycleAction(Request $request, $motorcycleId) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($motorcycleId);
            $form = $this->createMotorcycleForm($motorcycle);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $motorcycle = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($motorcycle);
                $em->flush();
                $message = "zmodyfikowałeś motocykl";
            } else {
                $message = "motocykl nie został zmodyfikoway";
            }
            return $this->render('ServiceBundle:Manager/Motorcycle:show_motorcycle.html.twig', array(
                        'message' => $message,
                        'motorcycle'=> $motorcycle
            ));
        }

        /**
         * @Route("/showAll", name="manager_show_all_motorcycles")
         * 
         */
        public function showAllMotorcyclesAction() {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycles = $repository->findAll();

            return $this->render('ServiceBundle:Manager/Motorcycle:show_motorcycles.html.twig', array(
                        'motorcycles' => $motorcycles
            ));
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
         * @Route("/showOne/{id}", name="manager_show_motorcycle")
         * 
         */
        public function showOneMotorcycleAction($id) {
            $repository = $this->getDoctrine()->getRepository('ServiceBundle:Motorcycle');
            $motorcycle = $repository->findOneById($id);
            $orders = $this->getMotorcycleOrders($motorcycle);

            return $this->render('ServiceBundle:Manager/Motorcycle:show_motorcycle.html.twig', array(
                        'motorcycle' => $motorcycle,
                        'orders' => $orders
            ));
        }

    }
    