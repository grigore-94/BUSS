<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/28/2017
 * Time: 10:11 PM
 */
namespace Bs\RouteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="routeStation")
 */
class RouteStation
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\StationBundle\Entity\Station", inversedBy="routeStations")
     * @ORM\JoinColumn(name="station_id", referencedColumnName="id")
     */
    private $station;
    /**
     * @ORM\Column(type="string")
     */
    private $distanceFromBackStation;

    /**
     * @ORM\Column(type="string")
     */
    private $timeFromBackStation;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\RouteBundle\Entity\Route", inversedBy="routeStations")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id")
     */
    private $route;
    /**
     * @ORM\Column(type="float")
     */
    private $position;

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
     * Set distanceFromBackStation
     *
     * @param string $distanceFromBackStation
     *
     * @return RouteStation
     */
    public function setDistanceFromBackStation($distanceFromBackStation)
    {
        $this->distanceFromBackStation = $distanceFromBackStation;

        return $this;
    }

    /**
     * Get distanceFromBackStation
     *
     * @return string
     */
    public function getDistanceFromBackStation()
    {
        return $this->distanceFromBackStation;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RouteStation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set timeFromBackStation
     *
     * @param string $timeFromBackStation
     *
     * @return RouteStation
     */
    public function setTimeFromBackStation($timeFromBackStation)
    {
        $this->timeFromBackStation = $timeFromBackStation;

        return $this;
    }

    /**
     * Get timeFromBackStation
     *
     * @return string
     */
    public function getTimeFromBackStation()
    {
        return $this->timeFromBackStation;
    }

    /**
     * Set position
     *
     * @param float $position
     *
     * @return RouteStation
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return float
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set station
     *
     * @param \Bs\StationBundle\Entity\Station $station
     *
     * @return RouteStation
     */
    public function setStation(\Bs\StationBundle\Entity\Station $station = null)
    {
        $this->station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return \Bs\StationBundle\Entity\Station
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * Set route
     *
     * @param \Bs\RouteBundle\Entity\Route $route
     *
     * @return RouteStation
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
}
