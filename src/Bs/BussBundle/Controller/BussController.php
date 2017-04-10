<?php

namespace Bs\BussBundle\Controller;

use Bs\AppBundle\Controller\BaseController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BussController extends BaseController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('BsBussBundle:Default:index.html.twig');
    }


    /**
     * @Route("/admin/view/busses/{filter}", name="view_busses")
     * @param static $filter
     * @return Response
     */
    public function viewAction($filter = null)
    {
        $em=$this->getEntityManager();
        if ($filter) {
            $busses=$em->getRepository("BsBussBundle:Buss")->findFilter($filter);
        } else {
            $busses=$em->getRepository("BsBussBundle:Buss")->findAll();
        }
        return $this->render(
            '@BsBuss/listBusses.html.twig',
            [
                'busses' => $busses,
                'filter'=>$filter
            ]

        );
    }
}
