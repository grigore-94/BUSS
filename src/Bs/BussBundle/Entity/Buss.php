<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/26/2017
 * Time: 9:57 PM
 */
namespace Bs\BussBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bs\BussBundle\Repository\BussRepository")
 * @ORM\Table(name="buss")
 */
class Buss
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
     * @ORM\Column(type="string")
     */
    private $seats;
    /**
     * @ORM\Column(type="string")
     */
    private $type;
    /**
     * @ORM\ManyToMany(targetEntity="Bs\RouteBundle\Entity\Route", mappedBy="busses")
     */
    private $routes;
    /**
     * @ORM\OneToMany(targetEntity="Bs\ItemRouteBundle\Entity\ItemRoute", mappedBy="buss")
     *
     */
    private $intemRoutes;

    private $uniqueName;

    /**
     * @return mixed
     */
    public function getUniqueName()
    {
        return sprintf('%s - %s - %s - %s', $this->id, $this->name, $this->seats, $this->type);
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->routes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->intemRoutes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Buss
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
     * Set type
     *
     * @param string $type
     *
     * @return Buss
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add route
     *
     * @param \Bs\RouteBundle\Entity\Route $route
     *
     * @return Buss
     */
    public function addRoute(\Bs\RouteBundle\Entity\Route $route)
    {
        $this->routes[] = $route;

        return $this;
    }

    /**
     * Remove route
     *
     * @param \Bs\RouteBundle\Entity\Route $route
     */
    public function removeRoute(\Bs\RouteBundle\Entity\Route $route)
    {
        $this->routes->removeElement($route);
    }

    /**
     * Get routes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Add intemRoute
     *
     * @param \Bs\ItemRouteBundle\Entity\ItemRoute $intemRoute
     *
     * @return Buss
     */
    public function addIntemRoute(\Bs\ItemRouteBundle\Entity\ItemRoute $intemRoute)
    {
        $this->intemRoutes[] = $intemRoute;

        return $this;
    }

    /**
     * Remove intemRoute
     *
     * @param \Bs\ItemRouteBundle\Entity\ItemRoute $intemRoute
     */
    public function removeIntemRoute(\Bs\ItemRouteBundle\Entity\ItemRoute $intemRoute)
    {
        $this->intemRoutes->removeElement($intemRoute);
    }

    /**
     * Get intemRoutes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntemRoutes()
    {
        return $this->intemRoutes;
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
