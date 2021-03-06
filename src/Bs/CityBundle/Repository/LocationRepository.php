<?php

namespace Bs\CityBundle\Repository;

use Bs\CityBundle\Entity\Location;
use Doctrine\ORM\EntityRepository;

/**
 * LocationRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class LocationRepository extends EntityRepository
{
    /**
     * @param $filter
     * @return Location[]
     */
    public function findFilter($filter)
    {
        $locations = $this->createQueryBuilder('l')

            ->where('l.city LIKE :filter')
            ->orWhere('l.region LIKE :filter')
            ->setParameter('filter', '%'.$filter.'%')
            ->getQuery()
            ->getResult();

        return $locations;
    }
}
