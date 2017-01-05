<?php

    namespace ServiceBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

    /**
     * Customer
     *
     * @ORM\Table(name="customer")
     * @ORM\Entity(repositoryClass="ServiceBundle\Repository\CustomerRepository")
     *  * @UniqueEntity(fields = "username", targetClass = "ServiceBundle\Entity\User", message="fos_user.username.already_used")
     * @UniqueEntity(fields = "email", targetClass = "ServiceBundle\Entity\User", message="fos_user.email.already_used")

     */
    class Customer extends User {

        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         * 
         */
        protected $id;

        /**
         * @var string
         *
         * @ORM\Column(name="name", type="string", length=25, nullable=true)
         */
        private $name;

        /**
         * @var string
         *
         * @ORM\Column(name="surname", type="string", length=25, nullable=true)
         */
        private $surname;

        /**
         * @var string
         *
         * @ORM\Column(name="phoneNo", type="string", length=15, nullable=true)
         */
        private $phoneNo;

        /**
         * @ORM\OneToOne(targetEntity="Address", mappedBy="user")
         */
        private $address;

        /**
         * 
         * @ORM\OneToMany(targetEntity="Motorcycle", mappedBy="userId")
         */
        private $motorcycles;

        
        public function __construct()
{
    parent::__construct();
    
    $this->roles = array('ROLE_MANAGER');
}

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
         * @return Customer
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
         * Set surname
         *
         * @param string $surname
         * @return Customer
         */
        public function setSurname($surname) {
            $this->surname = $surname;

            return $this;
        }

        /**
         * Get surname
         *
         * @return string 
         */
        public function getSurname() {
            return $this->surname;
        }

        /**
         * Set phoneNo
         *
         * @param string $phoneNo
         * @return Customer
         */
        public function setPhoneNo($phoneNo) {
            $this->phoneNo = $phoneNo;

            return $this;
        }

        /**
         * Get phoneNo
         *
         * @return string 
         */
        public function getPhoneNo() {
            return $this->phoneNo;
        }

    
    /**
     * Set address
     *
     * @param \ServiceBundle\Entity\Address $address
     * @return Customer
     */
    public function setAddress(\ServiceBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \ServiceBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add motorcycles
     *
     * @param \ServiceBundle\Entity\Motorcycle $motorcycles
     * @return Customer
     */
    public function addMotorcycle(\ServiceBundle\Entity\Motorcycle $motorcycles)
    {
        $this->motorcycles[] = $motorcycles;

        return $this;
    }

    /**
     * Remove motorcycles
     *
     * @param \ServiceBundle\Entity\Motorcycle $motorcycles
     */
    public function removeMotorcycle(\ServiceBundle\Entity\Motorcycle $motorcycles)
    {
        $this->motorcycles->removeElement($motorcycles);
    }

    /**
     * Get motorcycles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMotorcycles()
    {
        return $this->motorcycles;
    }
}
