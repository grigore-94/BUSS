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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CrudController extends Controller
{

    /**
     * @Route("/admin/add/location", name="add_location")
     * @param Request $request
     * @return RedirectResponse|Response
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

            return $this->redirectToRoute('view_locations');
        }

        return $this->render(
            '@BsCity/CRUD/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/admin/delete/location/{id}/{filter}", name="delete_location")
     * @param Location $location
     * @param string $filter
     * @return RedirectResponse
     */
    public function removeLocation(Location $location, $filter=null)
    {
        $em = $this->getEntityManager();
        $em->remove($location);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'The Location was successfully deleted.'
        );

        return $this->redirectToRoute('view_locations',['filter'=>$filter]);
    }


    /**
     * @Route("/admin/edit/location/{id}", name="edit_location")
     * @param Location $location
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Location $location)
    {
        $form = $this->createForm(LocationType::class, $location);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was updated added.'
            );

            return $this->redirectToRoute('view_locations');
        }

        return $this->render(
            '@BsCity/CRUD/add.html.twig',
            array('form' => $form->createView())
        );



    }

    /**
 * @return \Doctrine\Common\Persistence\ObjectManager
 */
    protected function getEntityManager()
    {
        $em = $this->getDoctrine()->getManager();

        return $em;
    }

}