<?php

namespace Bs\CityBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/28/2017
 * Time: 10:41 PM
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class City
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
     * @ORM\OneToMany(targetEntity="Bs\StationBundle\Entity\Station", mappedBy="city")
     */private $stations;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return City
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
     * Add station
     *
     * @param \Bs\StationBundle\Entity\Station $station
     *
     * @return City
     */
    public function addStation(\Bs\StationBundle\Entity\Station $station)
    {
        $this->stations[] = $station;

        return $this;
    }

    /**
     * Remove station
     *
     * @param \Bs\StationBundle\Entity\Station $station
     */
    public function removeStation(\Bs\StationBundle\Entity\Station $station)
    {
        $this->stations->removeElement($station);
    }

    /**
     * Get stations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStations()
    {
        return $this->stations;
    }
}
