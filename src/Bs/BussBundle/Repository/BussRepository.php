<?php

namespace Bs\BussBundle\Repository;

use Bs\BussBundle\Entity\Buss;
use Doctrine\ORM\EntityRepository;

/**
 * BussRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class BussRepository extends EntityRepository
{
    /**
     * @param $filter
     * @return Buss[]
     */
    public function findFilter($filter)
    {
        $stations = $this->createQueryBuilder('b')

            ->where('b.type LIKE :filter')
            ->orWhere('b.seats LIKE :filter')
            ->setParameter('filter', '%'.$filter.'%')
            ->getQuery()
            ->getResult();

        return $stations;
    }
}
