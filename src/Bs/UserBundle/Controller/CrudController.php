<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/2/2017
 * Time: 10:45 PM
 */

namespace Bs\UserBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Bs\CityBundle\Entity\Location;

use Bs\UserBundle\Entity\User;
use Bs\UserBundle\Form\UserType;
use Bs\UserBundle\Form\UserTypeEdit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CrudController extends BaseController
{
    /**
     * @Route("/admin/add/user", name="add_user")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was successfully added.'
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            '@BsUser/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/admin/delete/user/{id}/{filter}", name="delete_user")
     * @param User $user
     * @param string $filter
     * @return RedirectResponse
     */
    public function removeUser(User $user, $filter=null)
    {
        $em = $this->getEntityManager();
        $em->remove($user);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'The User was successfully deleted.'
        );

        return $this->redirectToRoute('view_users',['filter'=>$filter]);
    }

    /**
     * @Route("/admin/edit/user/{id}/{filter}", name="edit_user")
     * @param Request $request
     * @param User $user
     * @param null $filter
     * @return RedirectResponse|Response
     */
    public function editUserAction(Request $request, User $user, $filter=null)
    {
        $form = $this->createForm(UserTypeEdit::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'The user was succes ful updated.'
            );

            return $this->redirectToRoute('view_users',['filter'=>$filter]);
        }

        return $this->render(
            '@BsUser/add.html.twig',
            array('form' => $form->createView())
        );
    }
}