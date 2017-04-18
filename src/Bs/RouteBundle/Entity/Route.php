<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/26/2017
 * Time: 9:50 PM
 */
namespace Bs\RouteBundle\Entity;

use Bs\RouteBundle\Entity\RouteStation;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bs\RouteBundle\Repository\RouteRepository")
 * @ORM\Table(name="route")
 */
class Route
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="array")
     */
    private $activeDays;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\CityBundle\Entity\Location")
     * @ORM\JoinColumn(name="location_from_id", referencedColumnName="id")
     */
    private $from;
    /**
     * @ORM\ManyToOne(targetEntity="Bs\CityBundle\Entity\Location")
     * @ORM\JoinColumn(name="location_to_id", referencedColumnName="id")
     */
    private $to;
    /**
     * @ORM\Column(type="datetime")
     */
    private $hourDeparture;
    /**
     * @ORM\Column(type="datetime")
     */
    private $hourArive;
    /**
     * @ORM\OneToMany(targetEntity="Bs\RouteBundle\Entity\RouteStation", mappedBy="route")
     */
    private $routeStations;
    /**
     * @ORM\ManyToMany(targetEntity="Bs\BussBundle\Entity\Buss", inversedBy="routes")
     * @ORM\JoinTable(name="routes_busses")
     */
    private $busses;
    /**
     * @ORM\ManyToMany(targetEntity="Bs\DriverBundle\Entity\Driver", inversedBy="routes")
     * @ORM\JoinTable(name="routes_drivers")
     */
    private $drivers;
    /**
     * @ORM\OneToMany(targetEntity="Bs\ItemRouteBundle\Entity\ItemRoute", mappedBy="route")
     */
    private $itemRoutes;

    private $totalDistance;
    private $totalTime;

    public function getTotalDistance()
    {
        $this->totalDistance = 0;
        /**
         * @var $station RouteStation
         */
        foreach ($this->routeStations as $station) {

            $this->totalDistance += $station->getDistanceFromBackStation();
        }
        return $this->totalDistance;
    }

    public function getTotalTime()
    {

$this->totalTime = new \DateTime("00:00:00");


        /**
         * @var $station RouteStation
         */
        foreach ($this->routeStations as $station) {

            $this->totalTime =$this->addtime($this->totalTime,
                $station->getTimeFromBackStation()) ;
        }
        return $this->totalTime;
    }

    function addtime($time1,$time2)
    {
        $x = new DateTime($time1->format("h:i:s"));
        $y = new DateTime($time2->format("h:i:s"));

        $interval1 = $x->diff(new DateTime('00:00:00')) ;
        $interval2 = $y->diff(new DateTime('00:00:00')) ;

        $e = new DateTime('00:00');
        $f = clone $e;
        $e->add($interval1);
        $e->add($interval2);
        $total = $f->diff($e)->format("%H:%I:%S");
        return new DateTime($total);
    }
private $driver;

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param mixed $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->routeStations = new ArrayCollection();
        $this->busses = new ArrayCollection();
        $this->drivers = new ArrayCollection();
        $this->itemRoutes = new ArrayCollection();
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
     * Set activeDays
     *
     * @param string $activeDays
     *
     * @return Route
     */
    public function setActiveDays($activeDays)
    {
        $this->activeDays = $activeDays;

        return $this;
    }

    /**
     * Get activeDays
     *
     * @return array
     */
    public function getActiveDays()
    {
        return $this->activeDays;
    }

    /**
     * Set from
     *
     * @param string $from
     *
     * @return Route
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param string $to
     *
     * @return Route
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set hourDeparture
     *
     * @param string $hourDeparture
     *
     * @return Route
     */
    public function setHourDeparture($hourDeparture)
    {
        $this->hourDeparture = $hourDeparture;

        return $this;
    }

    /**
     * Get hourDeparture
     *
     * @return string
     */
    public function getHourDeparture()
    {
        return $this->hourDeparture;
    }

    /**
     * Set hourArive
     *
     * @param string $hourArive
     *
     * @return Route
     */
    public function setHourArive($hourArive)
    {
        $this->hourArive = $hourArive;

        return $this;
    }

    /**
     * Get hourArive
     *
     * @return string
     */
    public function getHourArive()
    {
        return $this->hourArive;
    }

    /**
     * Add routeStation
     *
     * @param RouteStation $routeStation
     *
     * @return Route
     */
    public function addRouteStation(RouteStation $routeStation)
    {
        $this->routeStations[] = $routeStation;

        return $this;
    }

    /**
     * Remove routeStation
     *
     * @param RouteStation $routeStation
     */
    public function removeRouteStation(RouteStation $routeStation)
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
     * Add buss
     *
     * @param \Bs\BussBundle\Entity\Buss $buss
     *
     * @return Route
     */
    public function addBuss(\Bs\BussBundle\Entity\Buss $buss)
    {
        $this->busses[] = $buss;

        return $this;
    }

    /**
     * Remove buss
     *
     * @param \Bs\BussBundle\Entity\Buss $buss
     */
    public function removeBuss(\Bs\BussBundle\Entity\Buss $buss)
    {
        $this->busses->removeElement($buss);
    }

    /**
     * Get busses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBusses()
    {
        return $this->busses;
    }

    /**
     * Add driver
     *
     * @param \Bs\DriverBundle\Entity\Driver $driver
     *
     * @return Route
     */
    public function addDriver(\Bs\DriverBundle\Entity\Driver $driver)
    {
        $this->drivers[] = $driver;

        return $this;
    }

    /**
     * Remove driver
     *
     * @param \Bs\DriverBundle\Entity\Driver $driver
     */
    public function removeDriver(\Bs\DriverBundle\Entity\Driver $driver)
    {
        $this->drivers->removeElement($driver);
    }

    /**
     * Get drivers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * Add itemRoute
     *
     * @param \Bs\ItemRouteBundle\Entity\ItemRoute $itemRoute
     *
     * @return Route
     */
    public function addItemRoute(\Bs\ItemRouteBundle\Entity\ItemRoute $itemRoute)
    {
        $this->itemRoutes[] = $itemRoute;

        return $this;
    }

    /**
     * Remove itemRoute
     *
     * @param \Bs\ItemRouteBundle\Entity\ItemRoute $itemRoute
     */
    public function removeItemRoute(\Bs\ItemRouteBundle\Entity\ItemRoute $itemRoute)
    {
        $this->itemRoutes->removeElement($itemRoute);
    }

    /**
     * Get itemRoutes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemRoutes()
    {
        return $this->itemRoutes;
    }
}
