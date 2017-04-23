<?php

namespace Bs\ItemRouteBundle\Entity;

use Bs\AppBundle\Models\SearchRoute;
use Bs\RouteBundle\Entity\Route;
use Doctrine\ORM\EntityRepository;


class ItemRouteRepository extends EntityRepository
{
    /**
     */
    public function getItemByRoute(Route $route,$date)
    {
        $result = $this->createQueryBuilder('i')

            ->where('i.route = :route')
            ->andWhere('i.date = :date')
            ->setParameters(
                [
                    'route' => $route,
                    'date' => $date,
                ]
            )
            ->getQuery()
            ->getResult();

        return $result;
    }

}
