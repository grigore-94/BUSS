<?php

namespace Bs\TicketBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Bs\PaymentBundle\Form\BookingType;
use Bs\PaymentBundle\Model\Booking;
use Bs\RouteBundle\Entity\RouteStation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    /**
     * @Route("/preview/ticket/{id}", name="preview_ticket")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $id)
    {


        $em = $this->getEntityManager();
        $itemRoute = $em->getRepository('BsItemRouteBundle:ItemRoute')->find($id);
        /** @var Booking $booking */
        $booking = $this->get('session')->get('booking');
        $fromStation = $em->getRepository('BsRouteBundle:RouteStation')->find($booking->getFromStation()->getId());
        $toStation = $em->getRepository('BsRouteBundle:RouteStation')->find($booking->getToStation()->getId());
        $booking->setFromStation($fromStation);
        $booking->setToStation($toStation);
        $route = $itemRoute->getRoute();
        $startPosition = $booking->getFromStation()->getPosition();
        $endPosition = $booking->getToStation()->getPosition();
        $distance = 0;
        /** @var RouteStation $routeStation */
        foreach ($route->getRouteStations() as $routeStation) {
            $routeStationPosition = $routeStation->getPosition();

            if ($routeStationPosition > $startPosition
                && $routeStationPosition <= $endPosition
            ) {
                $distance += $routeStation->getDistanceFromBackStation();
            }
        }

        $price = $em->getRepository('BsPaymentBundle:Price')->find(1);
        $totalPrice = $distance * $price->getPrice() * count($booking->getPlaces());
        $booking->setPrice($totalPrice);
        $booking->setTotalDistance($distance);
        $this->get('session')->set('booking', $booking);


        return $this->render('@BsPayment/previewTickets.html.twig',
            [
                'itemRoute' => $itemRoute,
                'booking' => $booking

            ]

        );
    }


    /**
     * @Route("/book/ticket/{id}", name="book_ticket")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bookAction(Request $request, $id)
    {

        $em = $this->getEntityManager();
        $itemRoute = $em->getRepository('BsItemRouteBundle:ItemRoute')->find($id);

        /** @var Booking $booking */
        $booking = $this->get('session')->get('booking');


        $em = $this->getDoctrine()->getManager();
        $allSelectedPlaces = $booking->getPlaces();
        if ($itemRoute->getPlaces() != null) {
            foreach ($itemRoute->getPlaces() as $place) {
                $allSelectedPlaces[] = $place;
            }
        }
        $itemRoute->setPlaces($allSelectedPlaces);
        $itemRoute->setFreeSeats($itemRoute->getSeats() - count($allSelectedPlaces));
        $em->persist($itemRoute);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Ticket was successfully .'
        );


        return $this->render('@BsPayment/payement.html.twig', ['booking' => $booking]);


    }


}
