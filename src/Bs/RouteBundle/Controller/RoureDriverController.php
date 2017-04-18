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
use Bs\RouteBundle\Form\RouteDriverType;
use Bs\RouteBundle\Form\RouteStationType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class RoureDriverController extends BaseController
{

    /**
     * @Route("/admin/add/route/drivers/{id}", name="add_route_drivers")
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request, $id)
    {
        $em = $this->getEntityManager();
        $route = $em->getRepository("BsRouteBundle:Route")->find($id);

        $form = $this->createForm(RouteDriverType::class, $route);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $route->addDriver($route->getDriver());
            $em->persist($route);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Route Driver was successfully added.'
            );

            return $this->redirectToRoute('view_route', ['id' => $id]);
        }

        return $this->render(
            '@BsRoute/RouteDrivers/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/admin/delete/route/{routeId}/driver/{driverId}", name="delete_route_driver")
     * @param $routeId
     * @param $driverId
     * @return RedirectResponse
     */
    public function deleteAction($routeId, $driverId)
    {
        $em = $this->getEntityManager();
        $route = $em->getRepository("BsRouteBundle:Route")->find($routeId);
        $driver = $em->getRepository("BsDriverBundle:Driver")->find($driverId);

        $route->removeDriver($driver);
        $em->persist($route);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Route Driver was successfully Deleted from this Route.'
        );


        return $this->redirectToRoute('view_route', ['id' => $route->getId()]);


    }
}