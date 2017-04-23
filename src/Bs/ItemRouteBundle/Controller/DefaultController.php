<?php

namespace Bs\ItemRouteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/itemRoutes/search")
     */
    public function listAction()
    {
        return $this->render('@BsItemRoute/listItemRoutes.html.twig');
    }
}
