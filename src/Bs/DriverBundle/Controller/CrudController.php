<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/4/2017
 * Time: 10:41 PM
 */

namespace Bs\DriverBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Bs\DriverBundle\Form\DriverType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Driver;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends BaseController
{
    /**
     * @Route("/admin/add/driver", name="add_driver")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $entity = new \Bs\DriverBundle\Entity\Driver();
        $form = $this->createForm(DriverType::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Driver was successfully added.'
            );

            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render(
            '@BsDriver/add.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * @Route("/admin/delete/driver/{id}/{filter}", name="delete_driver")
     * @param string $filter
     * @param $id
     * @return RedirectResponse
     */
    public function removeDriver($id, $filter = null)
    {
        $driver=$this->getEntityManager()->getRepository('BsDriverBundle:Driver')->find($id);
        $em = $this->getEntityManager();
        $em->remove($driver);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'The route was successfully deleted.'
        );

        return $this->redirectToRoute('view_drivers', ['filter' => $filter]);
    }


    /**
     * @Route("/admin/edit/driver/{id}", name="edit_driver")
     * @param  $id
     * @param  Request $request
     * @return RedirectResponse|Response
     */
    public function editAction($id, Request $request)
    {
        $driver=$this->getEntityManager()->getRepository('BsDriverBundle:Driver')->find($id);

        $form = $this->createForm(DriverType::class, $driver);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was updated added.'
            );

            return $this->redirectToDriver('view_drivers');
        }

        return $this->render(
            '@BsDriver/add.html.twig',
            array('form' => $form->createView())
        );


    }


}