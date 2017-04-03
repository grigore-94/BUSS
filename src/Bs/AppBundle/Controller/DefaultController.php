<?php

namespace Bs\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render(':default:index.html.twig');
    }

    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function indexAdminAction()
    {
        return $this->render('default/admin_index.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render(':default:contact.html.twig');
    }
}
