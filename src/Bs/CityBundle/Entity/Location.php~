<?php

namespace Bs\CityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/28/2017
 * Time: 10:41 PM
 * @ORM\Entity(repositoryClass="Bs\CityBundle\Repository\LocationRepository")
 * @ORM\Table(name="city")
 */
class Location
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
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="Bs\StationBundle\Entity\Station", mappedBy="location")
     */
    private $stations;

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    private $uniqueName;

    /**
     * @return mixed
     */
    public function getUniqueName()
    {
        return sprintf('%s ( %s )', $this->city, $this->region);
    }

    /**
     * @param mixed $uniqueName
     */
    public function setUniqueName($uniqueName)
    {
        $this->uniqueName = $uniqueName;
    }
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
