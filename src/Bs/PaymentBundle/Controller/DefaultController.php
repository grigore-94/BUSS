<?php

namespace Bs\PaymentBundle\Controller;

use Bs\AppBundle\Controller\BaseController;
use Bs\PaymentBundle\Form\PriceType;
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
}
