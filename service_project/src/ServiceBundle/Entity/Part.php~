<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parts
 *
 * @ORM\Table(name="parts")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\PartRepository")
 */
class Part
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
*@ORM\ManyToOne(targetEntity="ServiceOrder", inversedBy="usedParts")
     * @ORM\JoinColumn(name="serviceOrder", referencedColumnName="id")
     */
    private $serviceOrderId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;


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
     * Set serviceOrder
     *
     * @param integer $serviceOrder
     * @return Parts
     */
    public function setServiceOrderId($serviceOrder)
    {
        $this->serviceOrderId = $serviceOrder;

        return $this;
    }

    /**
     * Get serviceOrder
     *
     * @return integer 
     */
    public function getServiceOrderId()
    {
        return $this->serviceOrderId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Parts
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
     * Set price
     *
     * @param float $price
     * @return Parts
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     * @return Parts
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
