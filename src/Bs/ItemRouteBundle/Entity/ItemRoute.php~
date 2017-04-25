<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/26/2017
 * Time: 10:09 PM
 */
namespace Bs\ItemRouteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ItemRouteRepository")
 * @ORM\Table(name="item_route")
 */
class ItemRoute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\RouteBundle\Entity\Route", inversedBy="itemRoutes")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $route;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\DriverBundle\Entity\Driver", inversedBy="itemRoutes")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driver;
    /**
     * @ORM\Column(type="integer")
     */
    private $seats;

    /**
     * @ORM\Column(type="integer")
     */
    private $freeSeats;
    /**
     * @ORM\OneToMany(targetEntity="Bs\TicketBundle\Entity\Ticket", mappedBy="itemRoute")
     */
    private $tickets;

    /**
     * @ORM\ManyToOne(targetEntity="Bs\BussBundle\Entity\Buss", inversedBy="intemRoutes")
     * @ORM\JoinColumn(name="buss_id", referencedColumnName="id")
     */
    private $buss;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="array")
     */
    private $places;

    /**
     * @return mixed
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     *
     * @param string $places
     *
     * @return ItemRoute
     */
    public function setPlaces($places)
    {
        $this->places = $places;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getFreeSeats()
    {
        return $this->freeSeats;
    }

    /**
     * @param mixed $freeSeats
     */
    public function setFreeSeats($freeSeats)
    {
        $this->freeSeats = $freeSeats;
    }
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set seats
     *
     * @param string $seats
     *
     * @return ItemRoute
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return string
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set route
     *
     * @param \Bs\RouteBundle\Entity\Route $route
     *
     * @return ItemRoute
     */
    public function setRoute(\Bs\RouteBundle\Entity\Route $route = null)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return \Bs\RouteBundle\Entity\Route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set driver
     *
     * @param \Bs\DriverBundle\Entity\Driver $driver
     *
     * @return ItemRoute
     */
    public function setDriver(\Bs\DriverBundle\Entity\Driver $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \Bs\DriverBundle\Entity\Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Add ticket
     *
     * @param \Bs\TicketBundle\Entity\Ticket $ticket
     *
     * @return ItemRoute
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
     * Set buss
     *
     * @param \Bs\BussBundle\Entity\Buss $buss
     *
     * @return ItemRoute
     */
    public function setBuss(\Bs\BussBundle\Entity\Buss $buss = null)
    {
        $this->buss = $buss;

        return $this;
    }

    /**
     * Get buss
     *
     * @return \Bs\BussBundle\Entity\Buss
     */
    public function getBuss()
    {
        return $this->buss;
    }
}
