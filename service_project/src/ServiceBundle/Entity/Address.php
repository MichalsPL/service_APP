<?php

    namespace ServiceBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use ServiceBundle\Entity\User;

    /**
     * Address
     *
     * @ORM\Table(name="address")
     * @ORM\Entity(repositoryClass="ServiceBundle\Repository\AddressRepository")
     */
    class Address {

        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @var int
         * 
         * @ORM\OneToOne(targetEntity="Customer", inversedBy="address")
         * @ORM\JoinColumn(name="user", referencedColumnName="id")
         */
        private $user;

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

        /**
         * Get id
         *
         * @return integer 
         */
        public function getId() {
            return $this->id;
        }

        /**
         * Set userId
         *
         * @param integer $userId
         * @return Address
         */
        public function setUserId($userId) {
            $this->userId = $userId;

            return $this;
        }

        /**
         * Get userId
         *
         * @return integer 
         */
        public function getUserId() {
            return $this->userId;
        }

        /**
         * Set postalCode
         *
         * @param string $postalCode
         * @return Address
         */
        public function setPostalCode($postalCode) {
            $this->postalCode = $postalCode;

            return $this;
        }

        /**
         * Get postalCode
         *
         * @return string 
         */
        public function getPostalCode() {
            return $this->postalCode;
        }

        /**
         * Set street
         *
         * @param string $street
         * @return Address
         */
        public function setStreet($street) {
            $this->street = $street;

            return $this;
        }

        /**
         * Get street
         *
         * @return string 
         */
        public function getStreet() {
            return $this->street;
        }

        /**
         * Set city
         *
         * @param string $city
         * @return Address
         */
        public function setCity($city) {
            $this->city = $city;

            return $this;
        }

        /**
         * Get city
         *
         * @return string 
         */
        public function getCity() {
            return $this->city;
        }

        /**
         * Set houseNo
         *
         * @param string $houseNo
         * @return Address
         */
        public function setHouseNo($houseNo) {
            $this->houseNo = $houseNo;

            return $this;
        }

        /**
         * Get houseNo
         *
         * @return string 
         */
        public function getHouseNo() {
            return $this->houseNo;
        }

        /**
         * Set aptNo
         *
         * @param string $aptNo
         * @return Address
         */
        public function setAptNo($aptNo) {
            $this->aptNo = $aptNo;

            return $this;
        }

        /**
         * Get aptNo
         *
         * @return string 
         */
        public function getAptNo() {
            return $this->aptNo;
        }

    
    /**
     * Set user
     *
     * @param \ServiceBundle\Entity\User $user
     * @return Address
     */
    public function setUser(\ServiceBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ServiceBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
