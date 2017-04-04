<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/4/2017
 * Time: 10:41 PM
 */

namespace Bs\RouteBundle\Controller;



use Bs\RouteBundle\Form\RouteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends Controller
{
    /**
     * @Route("/add/route", name="add_route")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $entity = new \Bs\RouteBundle\Entity\Route();
        $form = $this->createForm(RouteType::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Route was successfully added.'
            );

            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render(
            '@BsRoute/add.html.twig',
            array('form' => $form->createView())
        );
    }
}