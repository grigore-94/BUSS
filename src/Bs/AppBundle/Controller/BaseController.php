<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/6/2017
 * Time: 10:55 PM
 */

namespace Bs\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function getEntityManager()
    {
        $em = $this->getDoctrine()->getManager();

        return $em;
    }

}