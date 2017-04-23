<?php

namespace Bs\AppBundle\Controller;

use Bs\AppBundle\Form\SearchType;
use Bs\AppBundle\Models\SearchRoute;
use Bs\ItemRouteBundle\Entity\ItemRoute;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {


        $search = new SearchRoute();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getEntityManager();
            $day = date("N", $search->getAtDate()->getTimeStamp())-1;

              $routes = $em->getRepository('BsRouteBundle:Route')->searcheRoute($search,$day);
            $itemRoutes=[];
            /** @var \Bs\RouteBundle\Entity\Route $route */
            foreach ($routes as $route) {
                  $itemRoute=$em->getRepository('BsItemRouteBundle:ItemRoute')->getItemByRoute($route,$search->getAtDate());
if ($itemRoutes == null) {
    $itemRoute= new ItemRoute();
    $itemRoute->setDriver($route->getDrivers()[0]);
    $itemRoute->setBuss($route->getBusses()[0]);
    $itemRoute->setRoute($route);
    $itemRoute->setSeats($itemRoute->getBuss()->getSeats());
    $itemRoute->setDate($search->getAtDate());

    $em->persist($itemRoute);
    $em->flush();
}
                  $itemRoutes[]=$itemRoute;
              }
            return $this->render('@BsItemRoute/listItemRoutes.html.twig',
                [
                    'itemRoutes'=>$itemRoutes,
                ]
                );
        }

        return $this->render(
            '@BsApp/Default/index.html.twig',
            array('form' => $form->createView())
        );
        return $this->render(':default:index.html.twig');
    }

    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function indexAdminAction()
    {
        return $this->render('default/admin_index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render(':default:contact.html.twig');
    }

}
