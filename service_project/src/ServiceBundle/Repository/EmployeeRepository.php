<?php

    namespace ServiceBundle\Repository;

    use Doctrine\ORM\EntityRepository;

    /**
     * EmployeeRepository
     *
     * This class was generated by the Doctrine ORM. Add your own custom
     * repository methods below.
     */
    class EmployeeRepository extends EntityRepository {

        public function getActiveMechanic() {
            $query = $this->getEntityManager()->createQuery(
                    "SELECT e FROM \ServiceBundle\Entity\Employee e WHERE e.roles"
                    . " LIKE '%ROLE_MECHANIC%' AND e.enabled = 1 ");
            $mechanics = $query->getResult();

            return $mechanics;
        }

        public function getActiveManager() {
            $query = $this->getEntityManager()->createQuery(
                    "SELECT e FROM \ServiceBundle\Entity\Employee e WHERE e.roles"
                    . " LIKE '%ROLE_MANAGER%' AND e.enabled = 1 ");
            $managers = $query->getResult();

            return $managers;
        }

        public function getAllAdmins() {
            $admins = $this->createQueryBuilder('e')
                    ->where('e.roles LIKE :role')
                    ->setParameter('role', '%ROLE_ADMIN%')
                    ->getQuery()
                    ->getResult();
        }

        public function getAllManagers() {
            $admins = $this->createQueryBuilder('e')
                    ->where('e.roles LIKE :role')
                    ->setParameter('role', '%ROLE_MANAGER%')
                    ->getQuery()
                    ->getResult();
        }

        public function getAllMechanics() {
            $admins = $this->createQueryBuilder('e')
                    ->where('e.roles LIKE :role')
                    ->setParameter('role', '%ROLE_MECHANIC%')
                    ->getQuery()
                    ->getResult();
        }

    }
    