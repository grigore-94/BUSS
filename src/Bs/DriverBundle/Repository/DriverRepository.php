<?php

namespace Bs\DriverBundle\Repository;

use Bs\DriverBundle\Entity\Driver;
use Doctrine\ORM\EntityRepository;

/**
 * DriverRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class DriverRepository extends EntityRepository
{
    /**
     * @param $filter
     * @return Driver[]
     */
    public function findFilter($filter)
    {
        $drivers = $this->createQueryBuilder('d')

            ->where('d.name LIKE :filter')
            ->orWhere('d.surename LIKE :filter')
            ->setParameter('filter', '%'.$filter.'%')
            ->getQuery()
            ->getResult();

        return $drivers;
    }
}