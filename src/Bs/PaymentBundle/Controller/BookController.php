<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/24/2017
 * Time: 11:33 AM
 */

namespace Bs\PaymentBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Bs\ItemRouteBundle\Entity\ItemRoute;
use Bs\PaymentBundle\Form\BookingType;
use Bs\PaymentBundle\Model\Booking;
use Bs\PaymentBundle\Model\BookTicket;
use Bs\RouteBundle\Entity\RouteStation;
use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends BaseController
{
    /**
     * @Route("/book/ticket/itemRoute/{id}", name="command_ticket")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request, $id)
    {
        $em = $this->getEntityManager();
        $itemRoute = $em->getRepository('BsItemRouteBundle:ItemRoute')->find($id);

        $entity = new Booking();
        $entity->setFromStation($this->getStartStations($itemRoute));
        $entity->setToStation($this->getStopStations($itemRoute));
        $entity->setNrPlaces($itemRoute->getSeats());
        $entity->setPlaces($itemRoute->getPlaces());


        /*$url = $this->generateUrl('preview_ticket', array('id' => $itemRoute->getId()));*/
        $form = $this->createForm(BookingType::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $this->get('session')->set('booking', $entity);

            return $this->redirectToRoute('preview_ticket',
                [
                    'id'=>$itemRoute->getId()
                ]);
        }

        return $this->render(
            '@BsPayment/create_booking.html.twig',
            array(
                'routeStations' => $itemRoute->getRoute()->getRouteStations(),
                'form' => $form->createView(),
            )
        );
    }


    /**
     * @param $itemRoute
     * @return array|null
     */
    private function getStartStations($itemRoute)
    {
        $stations = [];
        /** @var ItemRoute $itemRoute
         * @var RouteStation $routeStation
         */
        foreach ($itemRoute->getRoute()->getRouteStations() as $routeStation) {
            if ($routeStation->getCanBeStart())
                $stations[] = $routeStation;
        }
        if (!empty($stations)) {
            return $stations;
        }
        return null;
    }

    /**
     * @param $itemRoute
     * @return array|null
     */
    private function getStopStations($itemRoute)
    {
        $stations = [];
        /** @var ItemRoute $itemRoute
         * @var RouteStation $routeStation
         */
        foreach ($itemRoute->getRoute()->getRouteStations() as $routeStation) {
            if (!$routeStation->getCanBeStart())
                $stations[] = $routeStation;
        }
        if (!empty($stations)) {
            return $stations;
        }
        return null;
    }
}