<?php

namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    /**
     * @Route("/mechanic")
     */
class MechanicController extends Controller
{
     /**
         * @Route("/", name="mechanic_index")
         */
        public function managerIndexAction() {
            return $this->render('ServiceBundle:Mechanic:index.html.twig', array(
                            // ...
            ));
        }
}
