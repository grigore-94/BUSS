<?php

namespace Bs\StationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/28/2017
 * Time: 10:32 PM
 * @ORM\Entity(repositoryClass="Bs\StationBundle\Repository\StationRepository")
 * @ORM\Table(name="station")
 */
class Station
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
    private $name;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\CityBundle\Entity\Location", inversedBy="stations")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $location;
    /**
     * @ORM\OneToMany(targetEntity="Bs\RouteBundle\Entity\RouteStation", mappedBy="station")
     */
    private $routeStations;

    /**
     * @ORM\Column(type="float")
     */
    private $lat=47.02571087795901;

    /**
     * @ORM\Column(type="float")
     */
    private $lng=28.830940811157234;

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }


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
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
