<?php

namespace Bs\RouteBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends BaseController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('BsRouteBundle:Default:index.html.twig');
    }


    /**
     * @Route("/admin/view/routes/{filter}", name="view_routes")
     * @param static $filter
     * @return Response
     */
    public function viewAction($filter = null)
    {
        $em = $this->getEntityManager();
        if ($filter) {
            $routes = $em->getRepository("BsRouteBundle:Route")->findFilter($filter);
        } else {
            $routes = $em->getRepository("BsRouteBundle:Route")->findAll();
        }
        return $this->render(
            '@BsRoute/listRoutes.html.twig',
            [
                'routes' => $routes,
                'filter' => $filter
            ]

        );
    }


    /**
     * @Route("/admin/view/route/{id}", name="view_route")
     * @param $id
     * @return Response
     */
    public function viewRouteAction($id)
    {
        $em = $this->getEntityManager();
        $route = $em->getRepository("BsRouteBundle:Route")->find($id);
        $routeStations = $em->getRepository('BsRouteBundle:RouteStation')->findRouteStations($route);
       $daysOfWeek= array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wendnesday', 'Thursday', 'Friday');

       $date=date_format($route->getHourArive(), 'l');
$stationLocations=$route->getStationsArray();
$this->get('session')->set('stationsLocation',$stationLocations);
       return $this->render(
            '@BsRoute/viewRouteAdmin.html.twig',
            [
                'stationsLocation'=>$stationLocations,
                'route' => $route,
                'routeStations' => $routeStations,
                'daysOfWeek' => $daysOfWeek,

            ]

        );
    }

}

