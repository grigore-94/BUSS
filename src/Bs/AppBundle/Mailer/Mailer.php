<?php
/**
 * Created by PhpStorm.
 * User: gbrodicico
 * Date: 2/20/2017
 * Time: 1:27 PM
 */

namespace AppBundle\Mailer;




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

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     * @param $params
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, $params)
    {
        $this->mailer = $mailer;
        $this->params = $params;
        $this->twig = $twig;

    }

    /**
     * @param Job $job
     */
    public function sendJobEmailOnNewJob($job)
    {

        $bodyHtml = $this->twig->render(
            'email/email_job.html.twig',
            array('job' => $job)
        );
        $bodytext = $this->twig->render(
            'email/email_job.text.twig',
            array('job' => $job)
        );
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->params['from_email'], $this->params['from_name'])
            ->setTo($job->getEmail())
            ->setSubject(
                'Edit Your job Position :'.$job->getPosition()
            )
            ->setBody($bodyHtml, 'text/html')
            ->addPart($bodytext, 'text/plain');

        //->setContentType('text/html');

        $this->mailer->send($mail);
    }

    /**
     * @param Affiliate $affiliate
     * @param string $subject
     */
    public function sendAffiliateEmail($affiliate, $subject)
    {

        $bodyHtml = $this->twig->render(
            'email/email_affiliate.html.twig',
            array('affiliate' => $affiliate)
        );
        $bodytext = $this->twig->render(
            'email/email_affiliate.text.twig',
            array('affiliate' => $affiliate)
        );
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->params['from_email'], $this->params['from_name'])
            ->setTo($affiliate->getEmail())
            ->setSubject(
                $subject
            )
            ->setBody($bodyHtml, 'text/html')
            ->addPart($bodytext, 'text/plain');

        //->setContentType('text/html');

        $this->mailer->send($mail);
    }

    /**
     * @param Affiliate $affiliate
     * @param string $subject
     */
    public function sendAffiliateDeactivationEmail($affiliate, $subject)
    {


        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->params['from_email'], $this->params['from_name'])
            ->setTo($affiliate->getEmail())
            ->setSubject(
                $subject
            )
            ->setBody($subject, 'text/html');


        $this->mailer->send($mail);
    }
}