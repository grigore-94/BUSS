<?php

namespace Bs\RouteBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        $em=$this->getEntityManager();
        if ($filter) {
            $routes=$em->getRepository("BsRouteBundle:Route")->findFilter($filter);
        } else {
            $routes=$em->getRepository("BsRouteBundle:Route")->findAll();
        }
        return $this->render(
            '@BsRoute/listRoutes.html.twig',
            [
                'routes' => $routes,
                'filter'=>$filter
            ]

        );
    }
}
