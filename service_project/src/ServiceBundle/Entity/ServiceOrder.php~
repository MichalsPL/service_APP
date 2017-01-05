<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 use Doctrine\Common\Collections\ArrayCollection;
 

/**
 * ServiceOrder
 *
 * @ORM\Table(name="service_order")
 * @ORM\Entity(repositoryClass="Symfony\Bundle\ServiceBundle\Repository\ServiceOrderRepository")
 */
class ServiceOrder
{
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
     *@ORM\ManyToOne(targetEntity="Motorcycle", inversedBy="serviceOrder")
     * @ORM\JoinColumn(name="motorcycle", referencedColumnName="id")
     * 
     */
    private $motorcycle;

    /** 
     * 
     * 
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="mechanicMotorcycles")
     * @ORM\JoinColumn(name="mechanic", referencedColumnName="id")
     * 
     */
     
    private $mechanic;
    
       /** 
     * 
     * 
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="managerMotorcycles")
     * @ORM\JoinColumn(name="manager", referencedColumnName="id")
     * 
     */
     
    private $manager;

  

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfAcceptance", type="datetime", nullable=true)
     */
    private $dateOfAcceptance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfRelase", type="datetime", nullable=true)
     */
    private $dateOfRelase;

    /**
     * @ORM\OneToMany(targetEntity="Action", mappedBy="serviceOrder")
     */
    private $serviceActions;

    /**
     * @ORM\OneToMany(targetEntity="Part", mappedBy="serviceOrder")
     */
    private $usedParts;
    
      /**
     * @var int
     *
     * @ORM\Column(name="mileage", type="integer")
     */
    private $mileage;

    
   
    
    /**
     * @var string
     *
     * @ORM\Column(name="userComments", type="text", nullable=true)
     */
    private $userComments;

    /**
     * @var string
     *
     * @ORM\Column(name="managerComments", type="text", nullable=true)
     */
    private $managerComments;

    /**
     * @var string
     *
     * @ORM\Column(name="mechanicComments", type="text", nullable=true)
     */
    private $mechanicComments;

    /**
     * @ORM\ManyToOne(targetEntity="OrderStatus", inversedBy="orders")
     * @ORM\JoinColumn(name="orderStatus", referencedColumnName="id")
     */
    private $orderStatus;

    function __construct() {
        $this->usedParts = new ArrayCollection();
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
     * Set motorcycle
     *
     * @param integer $motorcycle
     * @return ServiceOrder
     */
    public function setMotorcycle($motorcycle)
    {
        $this->motorcycle = $motorcycle;

        return $this;
    }

    /**
     * Get motorcycle
     *
     * @return integer 
     */
    public function getMotorcycle()
    {
        return $this->motorcycle;
    }

    /**
     * Set mechanic
     *
     * @param integer $mechanic
     * @return ServiceOrder
     */
    public function setMechanic($mechanic)
    {
        $this->mechanic = $mechanic;

        return $this;
    }

    /**
     * Get mechanic
     *
     * @return integer 
     */
    public function getMechanic()
    {
        return $this->mechanic;
    }

    /**
     * Set manager
     *
     * @param integer $manager
     * @return ServiceOrder
     */
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return integer 
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return ServiceOrder
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return ServiceOrder
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set dateOfAcceptance
     *
     * @param \DateTime $dateOfAcceptance
     * @return ServiceOrder
     */
    public function setDateOfAcceptance($dateOfAcceptance)
    {
        $this->dateOfAcceptance = $dateOfAcceptance;

        return $this;
    }

    /**
     * Get dateOfAcceptance
     *
     * @return \DateTime 
     */
    public function getDateOfAcceptance()
    {
        return $this->dateOfAcceptance;
    }

    /**
     * Set dateOfRelase
     *
     * @param \DateTime $dateOfRelase
     * @return ServiceOrder
     */
    public function setDateOfRelase($dateOfRelase)
    {
        $this->dateOfRelase = $dateOfRelase;

        return $this;
    }

    /**
     * Get dateOfRelase
     *
     * @return \DateTime 
     */
    public function getDateOfRelase()
    {
        return $this->dateOfRelase;
    }

    /**
     * Set serviceActions
     *
     * @param integer $serviceActions
     * @return ServiceOrder
     */
    public function setServiceActions($serviceActions)
    {
        $this->serviceActions = $serviceActions;

        return $this;
    }

    /**
     * Get serviceActions
     *
     * @return integer 
     */
    public function getServiceActions()
    {
        return $this->serviceActions;
    }

    /**
     * Set usedParts
     *
     * @param integer $usedParts
     * @return ServiceOrder
     */
    public function setUsedParts($usedParts)
    {
        $this->usedParts = $usedParts;

        return $this;
    }

    /**
     * Get usedParts
     *
     * @return integer 
     */
    public function getUsedParts()
    {
        return $this->usedParts;
    }

    /**
     * Set userComments
     *
     * @param string $userComments
     * @return ServiceOrder
     */
    public function setUserComments($userComments)
    {
        $this->userComments = $userComments;

        return $this;
    }

    /**
     * Get userComments
     *
     * @return string 
     */
    public function getUserComments()
    {
        return $this->userComments;
    }

    /**
     * Set managerComments
     *
     * @param string $managerComments
     * @return ServiceOrder
     */
    public function setManagerComments($managerComments)
    {
        $this->managerComments = $managerComments;

        return $this;
    }

    /**
     * Get managerComments
     *
     * @return string 
     */
    public function getManagerComments()
    {
        return $this->managerComments;
    }

    /**
     * Set mechanicComments
     *
     * @param string $mechanicComments
     * @return ServiceOrder
     */
    public function setMechanicComments($mechanicComments)
    {
        $this->mechanicComments = $mechanicComments;

        return $this;
    }

    /**
     * Get mechanicComments
     *
     * @return string 
     */
    public function getMechanicComments()
    {
        return $this->mechanicComments;
    }

    /**
     * Set orderStatus
     *
     * @param integer $orderStatus
     * @return ServiceOrder
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return integer 
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Add serviceActions
     *
     * @param \ServiceBundle\Entity\Actions $serviceActions
     * @return ServiceOrder
     */
    public function addServiceAction(\ServiceBundle\Entity\Actions $serviceActions)
    {
        $this->serviceActions[] = $serviceActions;

        return $this;
    }

    /**
     * Remove serviceActions
     *
     * @param \ServiceBundle\Entity\Actions $serviceActions
     */
    public function removeServiceAction(\ServiceBundle\Entity\Actions $serviceActions)
    {
        $this->serviceActions->removeElement($serviceActions);
    }

    /**
     * Add usedParts
     *
     * @param \ServiceBundle\Entity\Parts $usedParts
     * @return ServiceOrder
     */
    public function addUsedPart(\ServiceBundle\Entity\Parts $usedParts)
    {
        $this->usedParts[] = $usedParts;

        return $this;
    }

    /**
     * Remove usedParts
     *
     * @param \ServiceBundle\Entity\Parts $usedParts
     */
    public function removeUsedPart(\ServiceBundle\Entity\Parts $usedParts)
    {
        $this->usedParts->removeElement($usedParts);
    }

    /**
     * Set mileage
     *
     * @param integer $mileage
     * @return ServiceOrder
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
}
