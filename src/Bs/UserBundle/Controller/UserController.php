<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/10/2017
 * Time: 9:20 PM
 */

namespace Bs\UserBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseController
{
    /**
     * @Route("/admin/view/users/{filter}", name="view_users")
     * @param string $filter
     * @return Response
     */
    public function viewAction($filter = null)
    {
        $em=$this->getEntityManager();
        if ($filter) {
            $users=$em->getRepository("BsUserBundle:User")->findFilter($filter);
        } else {
            $users=$em->getRepository("BsUserBundle:User")->findAll();
        }
        return $this->render(
            '@BsUser/listUsers.html.twig',
            [
                'users' => $users,
                'filter'=>$filter
            ]

        );
    }
}