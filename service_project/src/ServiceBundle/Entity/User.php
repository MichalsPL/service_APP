<?php

    namespace ServiceBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\Common\Collections\ArrayCollection;

    /**
     * User
     *
     * @ORM\Table(name="fos_user")
     * @ORM\Entity(repositoryClass="ServiceBundle\Repository\UserRepository")
     * @ORM\Entity
     * @ORM\InheritanceType("JOINED")
     * @ORM\DiscriminatorColumn(name="type", type="string")
     * @ORM\DiscriminatorMap({"employee" = "Employee", "customer" = "Customer"})
     */
   abstract  class User extends BaseUser {

        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         * 
         * 
         * 
         */
        protected $id;

    }
