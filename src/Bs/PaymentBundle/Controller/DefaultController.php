<?php

namespace Bs\PaymentBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Bs\PaymentBundle\Form\PriceType;
use Bs\PaymentBundle\Model\Booking;
use Bs\TicketBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    /**
     * @Route("admin/edit/price", name="edit_price")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $em = $this->getEntityManager();
        /** @var Price $price */
        $price = $em->getRepository('BsPaymentBundle:Price')->find(1);

        $form = $this->createForm(PriceType::class, $price);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em->persist($price);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'The Price was updated .'
            );

            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render(
            '@BsPayment/Price/add.html.twig',
            array('form' => $form->createView())
        );


    }

    /**
     * @Route("/payement/succes", name="succes_payement")
    0
     */
    public function succesAction()
    {
        $em = $this->getEntityManager();
        /** @var Booking $booking */
        $booking = $this->get('session')->get('booking');
        $itemRoute=$em->getRepository('BsItemRouteBundle:ItemRoute')->find($booking->getItemRoute()->getId());
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
$user= $em->getRepository("BsUserBundle:User")->find($this->getUser()->getId());
$ticket = new Ticket();

$ticket->setUser($user);
$ticket->setSeatsNo($booking->getPlaces());
$ticket->setPrice($booking->getPrice());
$ticket->setItemRoute($itemRoute);
$ticket->setFromStation($booking->getFromStation()->getName());
$ticket->setToStation($booking->getToStation()->getName());
$ticket->setDateBought(new \DateTime('now'));
$ticket->setBussNo($itemRoute->getBuss()->getName());
$ticket->setDistance($booking->getTotalDistance());
$em->persist($ticket);
$em->flush();
        return $this->render(
            '@BsPayment/succesPage.hmtl.twig',
            array(
                'user' => $this->getUser()
            )
        );


    }
}
