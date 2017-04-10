<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/4/2017
 * Time: 10:41 PM
 */

namespace Bs\BussBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Bs\BussBundle\Entity\Buss;
use Bs\BussBundle\Form\BussType;
use Bs\RouteBundle\Form\RouteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends BaseController
{
    /**
     * @Route("/admin/add/buss", name="add_buss")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $entity = new Buss();
        $form = $this->createForm(BussType::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Buss was successfully added.'
            );

            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render(
            '@BsBuss/add.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * @Route("/admin/delete/route/{id}/{filter}", name="delete_buss")
     * @param string $filter
     * @param $id
     * @return RedirectResponse
     */
    public function removeBuss($id, $filter = null)
    {
        $buss=$this->getEntityManager()->getRepository('BsBussBundle:Buss')->find($id);
        $em = $this->getEntityManager();
        $em->remove($buss);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'The buss was successfully deleted.'
        );

        return $this->redirectToRoute('view_busses', ['filter' => $filter]);
    }


    /**
     * @Route("/admin/edit/buss/{id}", name="edit_buss")
     * @param  $id
     * @param  Request $request
     * @return RedirectResponse|Response
     */
    public function editAction($id, Request $request)
    {
        $buss=$this->getEntityManager()->getRepository('BsBussBundle:Buss')->find($id);

        $form = $this->createForm(BussType::class, $buss);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($buss);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was updated added.'
            );

            return $this->redirectToRoute('view_busss');
        }

        return $this->render(
            '@BsBuss/add.html.twig',
            array('form' => $form->createView())
        );


    }


}