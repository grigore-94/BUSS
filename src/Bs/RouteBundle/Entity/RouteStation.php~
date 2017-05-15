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
 * @ORM\Entity(repositoryClass="Bs\RouteBundle\Repository\RouteStationRepository")
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
     * @ORM\Column(type="float")
     */
    private $distanceFromBackStation=0;

    /**
     * @ORM\Column(type="time")
     */
    private $timeFromBackStation;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\RouteBundle\Entity\Route", inversedBy="routeStations")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $route;
    /**
     * @ORM\Column(type="float")
     */
    private $position;

    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->station->getName();
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getCanBeStart()
    {
        return $this->canBeStart;
    }

    /**
     * @param mixed $canBeStart
     */
    public function setCanBeStart($canBeStart)
    {
        $this->canBeStart = $canBeStart;
    }
    /**
     * @ORM\Column(type="boolean")
     */private $canBeStart;
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
    public function getStation()
    {
        return $this->station;
    }

    /**
     * @param mixed $station
     */
    public function setStation($station)
    {
        $this->station = $station;
    }

    /**
     * @return mixed
     */
    public function getDistanceFromBackStation()
    {
        return $this->distanceFromBackStation;
    }

    /**
     * @param mixed $distanceFromBackStation
     */
    public function setDistanceFromBackStation($distanceFromBackStation)
    {
        $this->distanceFromBackStation = $distanceFromBackStation;
    }

    /**
     * @return mixed
     */
    public function getTimeFromBackStation()
    {
        return $this->timeFromBackStation;
    }

    /**
     * @param mixed $timeFromBackStation
     */
    public function setTimeFromBackStation($timeFromBackStation)
    {
        $this->timeFromBackStation = $timeFromBackStation;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }


}
