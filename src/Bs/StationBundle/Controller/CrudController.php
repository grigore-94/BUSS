<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/2/2017
 * Time: 10:45 PM
 */

namespace Bs\StationBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Bs\CityBundle\Entity\Location;
use Bs\StationBundle\Entity\Station;
use Bs\StationBundle\Form\StationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CrudController extends BaseController
{
    /**
     * @Route("/admin/add/station", name="add_station")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $station = new Station();
        $form = $this->createForm(StationType::class, $station);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($station);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was successfully added.'
            );

            return $this->redirectToRoute('view_stations');
        }

        return $this->render(
            '@BsStation/add.html.twig',
            ['form' => $form->createView(),
                'station' => $station,
                ]
        );
    }

    /**
     * @Route("/admin/delete/station/{id}/{filter}", name="delete_station")
     * @param Station $station
     * @param string $filter
     * @return RedirectResponse
     */
    public function removeStation(Station $station, $filter=null)
    {
        $em = $this->getEntityManager();
        $em->remove($station);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'The Station was successfully deleted.'
        );

        return $this->redirectToRoute('view_stations',['filter'=>$filter]);
    }

    /**
     * @Route("/admin/edit/station/{id}/{filter}", name="edit_station")
     * @param Request $request
     * @param Station $station
     * @param null $filter
     * @return RedirectResponse|Response
     */
    public function editStationAction(Request $request, Station $station, $filter=null)
    {
        $form = $this->createForm(StationType::class, $station);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($station);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'The station was succes ful updated.'
            );

            return $this->redirectToRoute('view_stations',['filter'=>$filter]);
        }

        return $this->render(
            '@BsStation/add.html.twig',
            array('form' => $form->createView())
        );
    }
}