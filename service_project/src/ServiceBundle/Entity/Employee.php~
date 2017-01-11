<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\EmployeeRepository")
 * 
 * 
 * @UniqueEntity(fields = "username", targetClass = "ServiceBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "ServiceBundle\Entity\User", message="fos_user.email.already_used")
 */
class Employee extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
         * @ORM\OneToMany(targetEntity="ServiceOrder", mappedBy="mechanic_id")
         */
        private $mechanicMotorcycles;
        
        /**
         * 
         * @ORM\OneToMany(targetEntity="ServiceOrder", mappedBy="manager_id")
         */
        private $managerMotorcycles;




        public function __construct() {
            parent::__construct();
            $this->motorcycles = new ArrayCollection();
            $this->mechanicMotorcycles = new ArrayCollection();
        }
        
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Employee
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Employee
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set phoneNo
     *
     * @param string $phoneNo
     * @return Employee
     */
    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;

        return $this;
    }

    /**
     * Get phoneNo
     *
     * @return string 
     */
    public function getPhoneNo()
    {
        return $this->phoneNo;
    }

    /**
     * Add motorcycles
     *
     * @param \ServiceBundle\Entity\Motorcycle $motorcycles
     * @return Employee
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
     * Add mechanicMotorcycles
     *
     * @param \ServiceBundle\Entity\ServiceOrder $mechanicMotorcycles
     * @return Employee
     */
    public function addMechanicMotorcycle(\ServiceBundle\Entity\ServiceOrder $mechanicMotorcycles)
    {
        $this->mechanicMotorcycles[] = $mechanicMotorcycles;

        return $this;
    }

    /**
     * Remove mechanicMotorcycles
     *
     * @param \ServiceBundle\Entity\ServiceOrder $mechanicMotorcycles
     */
    public function removeMechanicMotorcycle(\ServiceBundle\Entity\ServiceOrder $mechanicMotorcycles)
    {
        $this->mechanicMotorcycles->removeElement($mechanicMotorcycles);
    }

    /**
     * Get mechanicMotorcycles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMechanicMotorcycles()
    {
        return $this->mechanicMotorcycles;
    }

    /**
     * Add managerMotorcycles
     *
     * @param \ServiceBundle\Entity\ServiceOrder $managerMotorcycles
     * @return Employee
     */
    public function addManagerMotorcycle(\ServiceBundle\Entity\ServiceOrder $managerMotorcycles)
    {
        $this->managerMotorcycles[] = $managerMotorcycles;

        return $this;
    }

    /**
     * Remove managerMotorcycles
     *
     * @param \ServiceBundle\Entity\ServiceOrder $managerMotorcycles
     */
    public function removeManagerMotorcycle(\ServiceBundle\Entity\ServiceOrder $managerMotorcycles)
    {
        $this->managerMotorcycles->removeElement($managerMotorcycles);
    }

    /**
     * Get managerMotorcycles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getManagerMotorcycles()
    {
        return $this->managerMotorcycles;
    }

}
