<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/11/2017
 * Time: 11:23 PM
 */

namespace Bs\RouteBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Bs\RouteBundle\Entity\RouteStation;
use Bs\RouteBundle\Form\RouteStationType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouteStationController extends BaseController
{
    /**
     * @Route("/admin/add/route/station/{id}", name="add_route_station")
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request, $id)
    {
        $em = $this->getEntityManager();
        $route = $em->getRepository("BsRouteBundle:Route")->find($id);
        $entity = new RouteStation();
        $form = $this->createForm(RouteStationType::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $entity->setRoute($route);
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Route Station was successfully added.'
            );

            return $this->redirectToRoute('view_route', ['id' => $id]);
        }

        return $this->render(
            '@BsRoute/RouteStation/add.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * @Route("/admin/edit/route/station/{id}", name="edit_route_station")
     * @param Request $request
     * @param RouteStation $routeStation
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, RouteStation $routeStation)
    {
        $em = $this->getEntityManager();
        $form = $this->createForm(RouteStationType::class, $routeStation);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em->persist($routeStation);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Route Station was successfully Updated.'
            );
            /**
             * @var $route\Bs\RouteBundle\Entity\Route
             */
            $route = $routeStation->getRoute();

            return $this->redirectToRoute('view_route', ['id' => $route->getId()]);
        }

        return $this->render(
            '@BsRoute/RouteStation/edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/admin/delete/routestation/{id}", name="delete_route_station")
     * @param RouteStation $routeStation
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, RouteStation $routeStation)
    {
        /**
         * @var $route\Bs\RouteBundle\Entity\Route
         */
        $route = $routeStation->getRoute();
        $em = $this->getEntityManager();

        $route->removeRouteStation($routeStation);
        $routeStation->setRoute(null);
$em->remove($routeStation);
        $em->persist($route);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Route Station was successfully Updated.'
        );


        return $this->redirectToRoute('view_route', ['id' => $route->getId()]);


    }
}