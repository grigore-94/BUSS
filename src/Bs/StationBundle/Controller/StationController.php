<?php

namespace Bs\StationBundle\Controller;

use Bs\CityBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StationController extends BaseController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('BsStationBundle:Default:index.html.twig');
    }

    /**
     * @Route("/admin/view/station/{filter}", name="view_stations")
     * @param static $filter
     * @return Response
     */
    public function viewAction($filter = null)
    {
        $em=$this->getEntityManager();
        if ($filter) {
            $stations=$em->getRepository("BsStationBundle:Station")->findFilter($filter);
        } else {
            $stations=$em->getRepository("BsStationBundle:Station")->findAll();
        }
        return $this->render(
            '@BsStation/listStations.html.twig',
            [
                'stations' => $stations,
                'filter'=>$filter
            ]

        );
    }


    /**
     * @Route("/admin/view/location/stations/{id}", name="view_location_stations")
     * @param Location $location
     * @return Response
     */
    public function viewLocationStationsAction(Location $location,$filter=null)
    {

        if ($filter) {
            $em=$this->getEntityManager();
            $stations=$em->getRepository("BsStationBundle:Station")->findLocationStationsFilter($filter);
        } else {
            $stations=$location->getStations();
        }
        return $this->render(
            '@BsStation/listStations.html.twig',
            [
                'stations' => $stations,
                'filter'=>$filter
            ]

        );
    }




}
