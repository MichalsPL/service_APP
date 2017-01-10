<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actions
 *
 * @ORM\Table(name="actions")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\ActionRepository")
 */
class Action
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
*@ORM\ManyToOne(targetEntity="ServiceOrder", inversedBy="serviceActions")
     * @ORM\JoinColumn(name="serviceOrder", referencedColumnName="id")
     */
    private $serviceOrder;
   
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=40)
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
     * @ORM\Column(name="done", type="boolean",  options={"default" : 0}, nullable=true)
     */
    private $done;

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
     * @return Actions
     */
    public function setServiceOrder($serviceOrder)
    {
        $this->serviceOrder = $serviceOrder;

        return $this;
    }

    /**
     * Get serviceOrder
     *
     * @return integer 
     */
    public function getServiceOrder()
    {
        return $this->serviceOrder;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Actions
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
     * @return Actions
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
     * Set done
     *
     * @param \TINYINT $done
     * @return Actions
     */
    public function setDone(\TINYINT $done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return \TINYINT 
     */
    public function getDone()
    {
        return $this->done;
    }
}
