<?php

namespace Bs\RouteBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Bs\RouteBundle\Form\RouteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends BaseController
{
    /**
     * @Route("/add/route", name="add_route")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $entity = new \Bs\RouteBundle\Entity\Route();
        $form = $this->createForm(RouteType::class, $entity);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Route was successfully added.'
            );

            return $this->redirectToRoute('view_routes');
        }
        $stations = $em->getRepository('BsStationBundle:Station')->findAll();
        return $this->render(
            '@BsRoute/add.html.twig',
            array('form' => $form->createView(),
                'stationsLocation' => $this->getStationsArray($stations),
                'route' => $entity,
            )
        );
    }

    /**
     * @Route("/admin/delete/route/{id}/{filter}", name="delete_route")
     * @param string $filter
     * @param $id
     * @return RedirectResponse
     */
    public function removeRoute($id, $filter = null)
    {
        $route = $this->getEntityManager()->getRepository('BsRouteBundle:Route')->find($id);
        $em = $this->getEntityManager();
        $route->setDrivers(null);
        $route->setBusses(null);
        $em->flush();
        $em->remove($route);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'The route was successfully deleted.'
        );

        return $this->redirectToRoute('view_routes', ['filter' => $filter]);
    }

    /**
     * @Route("/admin/edit/route/{id}", name="edit_route")
     * @param  $id
     * @param  Request $request
     * @return RedirectResponse|Response
     */
    public function editAction($id, Request $request)
    {
        $route = $this->getEntityManager()->getRepository('BsRouteBundle:Route')->find($id);

        $form = $this->createForm(RouteType::class, $route);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em->persist($route);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was updated added.'
            );

            return $this->redirectToRoute('view_routes');
        }
        $stations = $em->getRepository('BsStationBundle:Station')->findAll();

        return $this->render(
            '@BsRoute/add.html.twig',
            array('form' => $form->createView(),
                'route' => $route,
                'stationsLocation' => $this->getStationsArray($stations),

            )
        );

    }

    public function getStationsArray($stations)
    {
        $array = [];
        /** @var RouteStation $station */
        foreach ($stations as $routeStation) {
            $item['name'] = $routeStation->getName();
            $item['lat'] = $routeStation->getLat();
            $item['lng'] = $routeStation->getLng();
            $array[] = $item;
        }
        return json_encode($array);
    }

}