<?php
/**
 * Created by PhpStorm.
 * User: gbrodicico
 * Date: 2/22/2017
 * Time: 4:09 PM
 */

namespace Bs\UserBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LogInController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @return Response
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        if (!$error) {
            $this->get('session')->getFlashBag()->add(
                'success',
                'LogIn success'
            );
        }
        return $this->render(
            '@BsUser/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );
    }

    /**
     * @Route("/logout", name="logout")
     * @return Response
     */
    public function logout()
    {
        $this->get('security.token_storage')->setToken(null);

        $this->get('session')->getFlashBag()->add(
            'success',
            'LogOut'
        );

        return $this->redirectToRoute('homepage');
    }
}
