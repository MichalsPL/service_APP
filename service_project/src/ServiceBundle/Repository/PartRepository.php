<?php

    namespace ServiceBundle\Repository;

    use Doctrine\ORM\EntityRepository;

    /**
     * PartsRepository
     *
     * This class was generated by the Doctrine ORM. Add your own custom
     * repository methods below.
     */
    class PartRepository extends EntityRepository {

        public function getPartsTotal($parts) {
            $sum = 0;
            foreach ($parts as $part) {
                $sum += $part->getPrice();
            }
            return $sum;
        }

    }
    