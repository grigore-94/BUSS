<?php

namespace Bs\CityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    /**
     * @Route("/admin/view/location/{filter}", name="view_locations")
     * @param static $filter
     * @return Response
     */
    public function viewAction($filter = null)
    {
        $em=$this->getEntityManager();
        if ($filter) {
$locations=$em->getRepository("BsCityBundle:Location")->findFilter($filter);
        } else {
            $locations=$em->getRepository("BsCityBundle:Location")->findAll();
        }
        return $this->render(
            '@BsCity/listLocation.html.twig',
            [
                'locations' => $locations,
                'filter'=>$filter
            ]

        );
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function getEntityManager()
    {
        $em = $this->getDoctrine()->getManager();

        return $em;
    }
}
