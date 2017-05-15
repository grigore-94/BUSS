<?php

namespace Bs\AppBundle\Controller;

use Bs\AppBundle\Form\SearchType;
use Bs\AppBundle\Models\SearchRoute;
use Bs\ItemRouteBundle\Entity\ItemRoute;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Mailer\Mailer;

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
            $day = date("N", $search->getAtDate()->getTimeStamp()) - 1;

            $routes = $em->getRepository('BsRouteBundle:Route')->searcheRoute($search, $day);
            $itemRoutes = [];
            /** @var \Bs\RouteBundle\Entity\Route $route */
            foreach ($routes as $route) {
                $itemRoute = $em->getRepository('BsItemRouteBundle:ItemRoute')->getItemByRoute($route, $search->getAtDate());
                if ($itemRoute == null) {
                    $itemRoute = new ItemRoute();
                    $itemRoute->setDriver($route->getDrivers()[0]);
                    $itemRoute->setBuss($route->getBusses()[0]);
                    $itemRoute->setRoute($route);
                    $itemRoute->setSeats($itemRoute->getBuss()->getSeats());
                    $itemRoute->setFreeSeats($itemRoute->getBuss()->getSeats());
                    $itemRoute->setDate($search->getAtDate());
                    $em->persist($itemRoute);
                    $em->flush();
                }
                $itemRoutes[] = $itemRoute;
            }
            $search->setF($search->getFrom()->getUniqueName());
            $search->setT($search->getTo()->getUniqueName());
            $form = $this->createForm(SearchType::class, $search);

            $price=$em->getRepository('BsPaymentBundle:Price')->find(1);
            return $this->render('@BsItemRoute/listItemRoutes.html.twig',
                [
                    'price'=>$price->getPrice(),
                    'form' => $form->createView(),
                    'itemRoutes' => $itemRoutes,
                ]
            );
        }


        return $this->render(
            '@BsApp/Default/index.html.twig',
            array('form' => $form->createView())
        );
        return $this->render(':default:index.html.twig');
    }

    private function getPlaces($p)
    {
        $aray = [];
        for ($i = 1; $i < $p; $i++) {
            $aray[$i] = 0;
        }
        return $aray;// array('Saturday'=>1, 'Sunday'=>2, 'Monday'=>3, 'Tuesday'=>4, 'Wendnesday'=>5, 'Thursday'=>6, 'Friday'=>7);

    }

    /**
     * @Route("admin", name="admin_homepage")
     */
    public function indexAdminAction()
    {
        return $this->redirectToRoute('view_routes');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render(':default:contact.html.twig');
    }

}
