<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 use ServiceBundle\Entity\User;
 use Doctrine\Common\Collections\ArrayCollection;

/**
 * Motorcycle
 *
 * @ORM\Table(name="motorcycle")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\MotorcycleRepository")
 */
class Motorcycle
{
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
     * 
     * 
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="motorcycles")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $userId;
    


    /**
     * @var string
     * 
     * @ORM\Column(name="type", type="string", length=30)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=30)
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=30)
     */
    private $model;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @var string
     *
     * @ORM\Column(name="regPlate", type="string", length=10, nullable=true, unique=true)
     */
    private $regPlate;

    /**
     * @var string
     *
     * @ORM\Column(name="vin", type="string", length=17, nullable=true, unique=true)
     */
    private $vin;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var int
     *
     * @ORM\Column(name="mileage", type="integer", nullable=true)
     */
    private $mileage;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10)
     */
    private $status;
    
     /**
     * @ORM\OneToMany(targetEntity="ServiceOrder", mappedBy="motorcycle")
     */
    private $serviceOrder;

    function __construct() {
        $this->serviceOrder = new ArrayCollection();
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
     * Set type
     *
     * @param integer $type
     * @return Motorcycle
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set make
     *
     * @param integer $make
     * @return Motorcycle
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return integer 
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Motorcycle
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return Motorcycle
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set regPlate
     *
     * @param string $regPlate
     * @return Motorcycle
     */
    public function setRegPlate($regPlate)
    {
        $this->regPlate = $regPlate;

        return $this;
    }

    /**
     * Get regPlate
     *
     * @return string 
     */
    public function getRegPlate()
    {
        return $this->regPlate;
    }

    /**
     * Set vin
     *
     * @param string $vin
     * @return Motorcycle
     */
    public function setVin($vin)
    {
        $this->vin = $vin;

        return $this;
    }

    /**
     * Get vin
     *
     * @return string 
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Motorcycle
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set mileage
     *
     * @param integer $mileage
     * @return Motorcycle
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return integer 
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Motorcycle
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Motorcycle
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Add serviceOrder
     *
     * @param \ServiceBundle\Entity\ServiceOrder $serviceOrder
     * @return Motorcycle
     */
    public function addServiceOrder(\ServiceBundle\Entity\ServiceOrder $serviceOrder)
    {
        $this->serviceOrder[] = $serviceOrder;

        return $this;
    }

    /**
     * Remove serviceOrder
     *
     * @param \ServiceBundle\Entity\ServiceOrder $serviceOrder
     */
    public function removeServiceOrder(\ServiceBundle\Entity\ServiceOrder $serviceOrder)
    {
        $this->serviceOrder->removeElement($serviceOrder);
    }

    /**
     * Get serviceOrder
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServiceOrder()
    {
        return $this->serviceOrder;
    }
}
