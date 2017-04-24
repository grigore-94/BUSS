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
     * @Route("view/itemRoutes/{idItemRoute}}}", name="view_item_itemRute")
     */
    public function viewAction($idItemRoute)
    {
        $em = $this->getEntityManager();
        $itemRoute = $em->getRepository('BsItemRouteBundle:ItemRoute')->find($idItemRoute);
        $route = $itemRoute->getRoute();
        $routeStations = $em->getRepository('BsRouteBundle:RouteStation')->findRouteStations($route);
        $daysOfWeek= array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wendnesday', 'Thursday', 'Friday');

        $date=date_format($route->getHourArive(), 'l');
        return $this->render(
            '@BsItemRoute/viewItemRoute.html.twig',
            [
                'route' => $route,
                'routeStations' => $routeStations,
                'daysOfWeek' => $daysOfWeek,

            ]

        );    }
}
