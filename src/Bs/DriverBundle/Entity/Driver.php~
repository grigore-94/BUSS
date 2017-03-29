<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/26/2017
 * Time: 9:59 PM
 */
namespace Bs\DriverBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="driver")
 */
class Driver
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id;
    /**
     * @ORM\Column(type="string")
     */private $name;
    /**
     * @ORM\Column(type="string")
     */private $surename;
    /**
     * @ORM\Column(type="string")
     */private $stage;
    /**
     * @ORM\ManyToMany(targetEntity="Bs\RouteBundle\Entity\Route",mappedBy="drivers")
     */private $routes;
    /**
     * @ORM\OneToMany(targetEntity="Bs\ItemRouteBundle\Entity\ItemRoute", mappedBy="driver")
     */private $itemRoutes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->routes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->itemRoutes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Driver
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
     * Set surename
     *
     * @param string $surename
     *
     * @return Driver
     */
    public function setSurename($surename)
    {
        $this->surename = $surename;

        return $this;
    }

    /**
     * Get surename
     *
     * @return string
     */
    public function getSurename()
    {
        return $this->surename;
    }

    /**
     * Set stage
     *
     * @param string $stage
     *
     * @return Driver
     */
    public function setStage($stage)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return string
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Add route
     *
     * @param \Bs\RouteBundle\Entity\Route $route
     *
     * @return Driver
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
     * Add itemRoute
     *
     * @param \Bs\ItemRouteBundle\Entity\ItemRoute $itemRoute
     *
     * @return Driver
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
