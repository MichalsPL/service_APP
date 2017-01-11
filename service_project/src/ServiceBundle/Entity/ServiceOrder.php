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
     * @ORM\JoinColumn(name="mechanic_id", referencedColumnName="id")
     * 
     */
     
    private $mechanicId;
    
       /** 
     * 
     * 
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="managerMotorcycles")
     * @ORM\JoinColumn(name="manager_id", referencedColumnName="id")
     * 
     */
     
    private $managerId;

  

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
     * @ORM\OneToMany(targetEntity="Action", mappedBy="serviceOrderId")
     */
    private $serviceActions;

    /**
     * @ORM\OneToMany(targetEntity="Part", mappedBy="serviceOrderId")
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
     * @ORM\JoinColumn(name="orderStatusId", referencedColumnName="id")
     */
    private $orderStatusId;


    function __construct() {
         $this->serviceActions = new ArrayCollection();
        $this->usedParts = new ArrayCollection();
        $this->dateOfAcceptance = new \DateTime();
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();
        $this->dateOfRelase = new \DateTime();
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
     * Set motorcycle
     *
     * @param \ServiceBundle\Entity\Motorcycle $motorcycle
     * @return ServiceOrder
     */
    public function setMotorcycle(\ServiceBundle\Entity\Motorcycle $motorcycle = null)
    {
        $this->motorcycle = $motorcycle;

        return $this;
    }

    /**
     * Get motorcycle
     *
     * @return \ServiceBundle\Entity\Motorcycle 
     */
    public function getMotorcycle()
    {
        return $this->motorcycle;
    }

    /**
     * Set mechanicId
     *
     * @param \ServiceBundle\Entity\Employee $mechanicId
     * @return ServiceOrder
     */
    public function setMechanicId(\ServiceBundle\Entity\Employee $mechanicId = null)
    {
        $this->mechanicId = $mechanicId;

        return $this;
    }

    /**
     * Get mechanicId
     *
     * @return \ServiceBundle\Entity\Employee 
     */
    public function getMechanicId()
    {
        return $this->mechanicId;
    }

    /**
     * Set managerId
     *
     * @param \ServiceBundle\Entity\Employee $managerId
     * @return ServiceOrder
     */
    public function setManagerId(\ServiceBundle\Entity\Employee $managerId = null)
    {
        $this->managerId = $managerId;

        return $this;
    }

    /**
     * Get managerId
     *
     * @return \ServiceBundle\Entity\Employee 
     */
    public function getManagerId()
    {
        return $this->managerId;
    }

    /**
     * Add serviceActions
     *
     * @param \ServiceBundle\Entity\Action $serviceActions
     * @return ServiceOrder
     */
    public function addServiceAction(\ServiceBundle\Entity\Action $serviceActions)
    {
        $this->serviceActions[] = $serviceActions;

        return $this;
    }

    /**
     * Remove serviceActions
     *
     * @param \ServiceBundle\Entity\Action $serviceActions
     */
    public function removeServiceAction(\ServiceBundle\Entity\Action $serviceActions)
    {
        $this->serviceActions->removeElement($serviceActions);
    }

    /**
     * Get serviceActions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServiceActions()
    {
        return $this->serviceActions;
    }

    /**
     * Add usedParts
     *
     * @param \ServiceBundle\Entity\Part $usedParts
     * @return ServiceOrder
     */
    public function addUsedPart(\ServiceBundle\Entity\Part $usedParts)
    {
        $this->usedParts[] = $usedParts;

        return $this;
    }

    /**
     * Remove usedParts
     *
     * @param \ServiceBundle\Entity\Part $usedParts
     */
    public function removeUsedPart(\ServiceBundle\Entity\Part $usedParts)
    {
        $this->usedParts->removeElement($usedParts);
    }

    /**
     * Get usedParts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsedParts()
    {
        return $this->usedParts;
    }

    /**
     * Set orderStatusId
     *
     * @param \ServiceBundle\Entity\OrderStatus $orderStatusId
     * @return ServiceOrder
     */
    public function setOrderStatusId(\ServiceBundle\Entity\OrderStatus $orderStatusId = null)
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    /**
     * Get orderStatusId
     *
     * @return \ServiceBundle\Entity\OrderStatus 
     */
    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }
}
