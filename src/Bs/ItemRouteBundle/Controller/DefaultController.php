<?php

namespace Bs\ItemRouteBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Bs\ItemRouteBundle\Entity\ItemRoute;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/itemRoutes/search")
     */
    public function listAction()
    {
        return $this->render('@BsItemRoute/listItemRoutes.html.twig');
    }

    /**
     * @Route("view/itemRoutes/{id}}}", name="view_item_itemRute")
     */
    public function viewAction($id)
    {
        $em = $this->getEntityManager();
        $itemRoute = $em->getRepository('BsItemRouteBundle:ItemRoute')->find($id);
        $route = $itemRoute->getRoute();
        $routeStations = $em->getRepository('BsRouteBundle:RouteStation')->findRouteStations($route);
        $daysOfWeek= array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wendnesday', 'Thursday', 'Friday');

        $date=date_format($route->getHourArive(), 'l');

        return $this->render(
            '@BsItemRoute/viewItemRoute.html.twig',
            [
                'buss'=>$route->getBuss(),
                'stationsLocation'=>$route->getStationsArray(),
                'itemRoute'=>$itemRoute,
                'route' => $route,
                'routeStations' => $routeStations,
                'daysOfWeek' => $daysOfWeek,

            ]

        );    }
}
