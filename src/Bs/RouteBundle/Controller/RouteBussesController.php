<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/18/2017
 * Time: 10:49 PM
 */

namespace Bs\RouteBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Bs\DriverBundle\Entity\Driver;
use Bs\RouteBundle\Entity\RouteStation;
use Bs\RouteBundle\Form\RouteBussType;
use Bs\RouteBundle\Form\RouteDriverType;
use Bs\RouteBundle\Form\RouteStationType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class RouteBussesController extends BaseController
{

    /**
     * @Route("/admin/add/route/buss/{id}", name="add_route_buss")
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request, $id)
    {
        $em = $this->getEntityManager();
        $route = $em->getRepository("BsRouteBundle:Route")->find($id);

        $form = $this->createForm(RouteBussType::class, $route);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $route->addBuss($route->getBuss());
            $em->persist($route);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Route Buss was successfully added.'
            );

            return $this->redirectToRoute('view_route', ['id' => $id]);
        }

        return $this->render(
            '@BsRoute/RouteBusses/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/admin/delete/route/{routeId}/buss/{bussId}", name="delete_route_buss")
     * @param $routeId
     * @param $bussId
     * @return RedirectResponse
     */
    public function deleteAction($routeId, $bussId)
    {
        $em = $this->getEntityManager();
        $route = $em->getRepository("BsRouteBundle:Route")->find($routeId);
        $buss = $em->getRepository("BsBussBundle:Buss")->find($bussId);

        $route->removeBuss($buss);
        $em->persist($route);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Route Buss was successfully Deleted from this Route.'
        );


        return $this->redirectToRoute('view_route', ['id' => $route->getId()]);


    }
}