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
         * 
         * @ORM\OneToMany(targetEntity="Motorcycle", mappedBy="customer_id")
         */
        private $motorcycles;

         /**
         * @var string
         *
         * @ORM\Column(name="postalCode", type="string", length=6, nullable=true)
         */
        private $postalCode;

        /**
         * @var string
         *
         * @ORM\Column(name="street", type="string", length=30, nullable=true)
         */
        private $street;

        /**
         * @var string
         *
         * @ORM\Column(name="city", type="string", length=30, nullable=true)
         */
        private $city;

        /**
         * @var string
         *
         * @ORM\Column(name="houseNo", type="string", length=10, nullable=true)
         */
        private $houseNo;

        /**
         * @var string
         *
         * @ORM\Column(name="aptNo", type="string", length=10, nullable=true)
         */
        private $aptNo;

        
        public function __construct()
{
    parent::__construct();
    
    $this->roles = array('ROLE_USER');
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

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return Customer
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Customer
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set houseNo
     *
     * @param string $houseNo
     * @return Customer
     */
    public function setHouseNo($houseNo)
    {
        $this->houseNo = $houseNo;

        return $this;
    }

    /**
     * Get houseNo
     *
     * @return string 
     */
    public function getHouseNo()
    {
        return $this->houseNo;
    }

    /**
     * Set aptNo
     *
     * @param string $aptNo
     * @return Customer
     */
    public function setAptNo($aptNo)
    {
        $this->aptNo = $aptNo;

        return $this;
    }

    /**
     * Get aptNo
     *
     * @return string 
     */
    public function getAptNo()
    {
        return $this->aptNo;
    }
}
