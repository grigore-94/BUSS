<?php

namespace Bs\UserBundle\Controller;


use Bs\UserBundle\Form\UserType;
use Bs\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function registerAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setIsActive(true);
            $user->setRoles(array('ROLE_ADMIN'));
            if ($user->getReleasedAt() == null) {
                $user->setReleasedAt(new \DateTime('now'));
            }
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
            '@BsUser/registration/new_registration.html.twig',
            array('form' => $form->createView())
        );
    }
}
