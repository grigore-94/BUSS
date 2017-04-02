<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/2/2017
 * Time: 10:45 PM
 */

namespace Bs\StationBundle\Controller;


use Bs\StationBundle\Entity\Station;
use Bs\StationBundle\Form\StationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CrudController extends Controller
{
    /**
     * @Route("/add/station", name="add_station")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            '@BsStation/add.html.twig',
            array('form' => $form->createView())
        );
    }
}