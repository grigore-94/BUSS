<?php

namespace Bs\AppBundle\Mailer;




use Bs\RouteBundle\Entity\Route;
use Bs\TicketBundle\Entity\Ticket;
use Doctrine\ORM\EntityNotFoundException;
use Swift_Message;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Mailer
{
    protected $mailer;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    protected $container;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     * @param $params
     * @param ContainerInterface $container
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, $params,ContainerInterface $container)
    {
        $this->mailer = $mailer;
        $this->params = $params;
        $this->twig = $twig;
        $this->container=$container;

    }


    /**
     * @param Ticket $ticket
     * @param Route $route
     * @param string $email
     */
    public function sendTicketEmail($ticket, $route, $email,$view)
    {



        $mail = Swift_Message::newInstance();

        $mail
            ->setFrom($this->params['from_email'], $this->params['from_name'])
            ->setTo($email)
            ->setSubject(
                'Your ticket for Route :'. $route->getFrom()->getUniqueName(). 'to' . $route->getTo()->getUniqueName()
            )
          //  ->attach($a)
            ->setBody($view, 'text/html');


        //->setContentType('text/html');

        $this->mailer->send($mail);
    }


}