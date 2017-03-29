<?php

namespace Bs\StationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/28/2017
 * Time: 10:32 PM
 * @ORM\Entity
 * @ORM\Table(name="station")
 */
class Station
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\CityBundle\Entity\City", inversedBy="stations")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */private $city;
    /**
     * @ORM\OneToMany(targetEntity="Bs\RouteBundle\Entity\RouteStation", mappedBy="station")
     */private $routeStations;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->routeStations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set city
     *
     * @param \Bs\CityBundle\Entity\City $city
     *
     * @return Station
     */
    public function setCity(\Bs\CityBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Bs\CityBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add routeStation
     *
     * @param \Bs\RouteBundle\Entity\RouteStation $routeStation
     *
     * @return Station
     */
    public function addRouteStation(\Bs\RouteBundle\Entity\RouteStation $routeStation)
    {
        $this->routeStations[] = $routeStation;

        return $this;
    }

    /**
     * Remove routeStation
     *
     * @param \Bs\RouteBundle\Entity\RouteStation $routeStation
     */
    public function removeRouteStation(\Bs\RouteBundle\Entity\RouteStation $routeStation)
    {
        $this->routeStations->removeElement($routeStation);
    }

    /**
     * Get routeStations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRouteStations()
    {
        return $this->routeStations;
    }
}
