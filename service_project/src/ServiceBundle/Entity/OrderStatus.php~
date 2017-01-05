<?php

    namespace ServiceBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * OrderStatus
     *
     * @ORM\Table(name="order_status")
     * @ORM\Entity(repositoryClass="ServiceBundle\Repository\OrderStatusRepository")
     */
    class OrderStatus {

        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         * 

         */
        private $id;

        /**
         * @var string
         *
         * @ORM\Column(name="name", type="string", length=15, unique=true)
         */
        private $name;

        /**
         * 
         * 
         * @ORM\OneToMany(targetEntity="ServiceOrder", mappedBy="orderStatus")
         */
        private $orders;

        /**
         * Get id
         *
         * @return integer 
         */
        public function getId() {
            return $this->id;
        }

        /**
         * Set name
         *
         * @param string $name
         * @return OrderStatus
         */
        public function setName($name) {
            $this->name = $name;

            return $this;
        }

        /**
         * Get name
         *
         * @return string 
         */
        public function getName() {
            return $this->name;
        }

        /**
         * Constructor
         */
        public function __construct() {
            $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
        }

        /**
         * Add orders
         *
         * @param \ServiceBundle\Entity\ServiceOrder $orders
         * @return OrderStatus
         */
        public function addOrder(\ServiceBundle\Entity\ServiceOrder $orders) {
            $this->orders[] = $orders;

            return $this;
        }

        /**
         * Remove orders
         *
         * @param \ServiceBundle\Entity\ServiceOrder $orders
         */
        public function removeOrder(\ServiceBundle\Entity\ServiceOrder $orders) {
            $this->orders->removeElement($orders);
        }

        /**
         * Get orders
         *
         * @return \Doctrine\Common\Collections\Collection 
         */
        public function getOrders() {
            return $this->orders;
        }

    }
