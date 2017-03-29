<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/26/2017
 * Time: 9:38 PM
 */
namespace Bs\PaymentBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment")
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $value;
    /**
     * @ORM\OneToMany(targetEntity="Bs\TicketBundle\Entity\Ticket", mappedBy="payment")
     */
    private $tickets;
    /**
     * @ORM\OneToMany(targetEntity="Bs\UserBundle\Entity\User", mappedBy="cards" )
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\PaymentBundle\Entity\Card", inversedBy="payments")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     */
    private $card;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Payment
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add ticket
     *
     * @param \Bs\TicketBundle\Entity\Ticket $ticket
     *
     * @return Payment
     */
    public function addTicket(\Bs\TicketBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \Bs\TicketBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\Bs\TicketBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Add user
     *
     * @param \Bs\UserBundle\Entity\User $user
     *
     * @return Payment
     */
    public function addUser(\Bs\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Bs\UserBundle\Entity\User $user
     */
    public function removeUser(\Bs\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set card
     *
     * @param \Bs\PaymentBundle\Entity\Card $card
     *
     * @return Payment
     */
    public function setCard(\Bs\PaymentBundle\Entity\Card $card = null)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Get card
     *
     * @return \Bs\PaymentBundle\Entity\Card
     */
    public function getCard()
    {
        return $this->card;
    }
}
