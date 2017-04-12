<?php

namespace Bs\DriverBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DriverController extends BaseController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('BsDriverBundle:Default:index.html.twig');
    }

    /**
     * @Route("/admin/view/drivers/{filter}", name="view_drivers")
     * @param static $filter
     * @return Response
     */
    public function viewAction($filter = null)
    {
        $em=$this->getEntityManager();
        if ($filter) {
            $drivers=$em->getRepository("BsDriverBundle:Driver")->findFilter($filter);
        } else {
            $drivers=$em->getRepository("BsDriverBundle:Driver")->findAll();
        }
        return $this->render(
            '@BsDriver/listDrivers.html.twig',
            [
                'drivers' => $drivers,
                'filter'=>$filter
            ]

        );
    }
}
