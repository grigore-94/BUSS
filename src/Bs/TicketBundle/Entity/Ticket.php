<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/26/2017
 * Time: 9:30 PM
 */

namespace Bs\TicketBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ticket")
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id;
    /**
     * @ORM\Column(type="string")
     */private $dateBought;
    /**
     * @ORM\Column(type="string")
     */private $price;
    /**
     * @ORM\Column(type="string")
     */private $seatNo;
    /**
     * @ORM\Column(type="string")
     */private $bussNo;
    /**
     * @ORM\Column(type="string")
     */private $from;
    /**
     * @ORM\Column(type="string")
     */private $to;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\PaymentBundle\Entity\Payment", inversedBy="tickets")
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     */private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="Bs\UserBundle\Entity\User", inversedBy="tickets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Bs\ItemRouteBundle\Entity\ItemRoute", inversedBy="tickets")
     * @ORM\JoinColumn(name="itemRoute_id", referencedColumnName="id")
     */
    private $itemRoute;
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDateBought()
    {
        return $this->dateBought;
    }

    /**
     * @param mixed $dateBought
     */
    public function setDateBought($dateBought)
    {
        $this->dateBought = $dateBought;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSeatNo()
    {
        return $this->seatNo;
    }

    /**
     * @param mixed $seatNo
     */
    public function setSeatNo($seatNo)
    {
        $this->seatNo = $seatNo;
    }

    /**
     * @return mixed
     */
    public function getBussNo()
    {
        return $this->bussNo;
    }

    /**
     * @param mixed $bussNo
     */
    public function setBussNo($bussNo)
    {
        $this->bussNo = $bussNo;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }


    /**
     * Set itemRoute
     *
     * @param \Bs\ItemRouteBundle\Entity\ItemRoute $itemRoute
     *
     * @return Ticket
     */
    public function setItemRoute(\Bs\ItemRouteBundle\Entity\ItemRoute $itemRoute = null)
    {
        $this->itemRoute = $itemRoute;

        return $this;
    }

    /**
     * Get itemRoute
     *
     * @return \Bs\ItemRouteBundle\Entity\ItemRoute
     */
    public function getItemRoute()
    {
        return $this->itemRoute;
    }
}
