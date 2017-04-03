<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/3/2017
 * Time: 8:56 PM
 */

namespace Bs\CityBundle\Controller;


use Bs\CityBundle\Entity\Location;
use Bs\CityBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CrudController extends Controller
{

    /**
     * @Route("/add/location", name="add_location")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was successfully added.'
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            '@BsCity/CRUD/add.html.twig',
            array('form' => $form->createView())
        );
    }
}