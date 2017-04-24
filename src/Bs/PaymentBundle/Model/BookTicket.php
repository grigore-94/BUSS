<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/23/2017
 * Time: 11:14 PM
 */

namespace Bs\PaymentBundle\Model;

class BookTicket
{
    private $itemRoute;
    private $fromStation;

    private $toStation;

    private $places;
private $nrPlaces;
    private $price;

    /**
     * @return mixed
     */
    public function getNrPlaces()
    {
        return $this->nrPlaces;
    }

    /**
     * @param mixed $nrPlaces
     */
    public function setNrPlaces($nrPlaces)
    {
        $this->nrPlaces = $nrPlaces;
    }
    /**
     * @return mixed
     */
    public function getItemRoute()
    {
        return $this->itemRoute;
    }

    /**
     * @param mixed $itemRoute
     */
    public function setItemRoute($itemRoute)
    {
        $this->itemRoute = $itemRoute;
    }

    /**
     * @return mixed
     */
    public function getFromStation()
    {
        return $this->fromStation;
    }

    /**
     * @param mixed $fromStation
     */
    public function setFromStation($fromStation)
    {
        $this->fromStation = $fromStation;
    }

    /**
     * @return mixed
     */
    public function getToStation()
    {
        return $this->toStation;
    }

    /**
     * @param mixed $toStation
     */
    public function setToStation($toStation)
    {
        $this->toStation = $toStation;
    }

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
     * @return BookTicket
     */
    public function setPlaces($places)
    {
        $this->places = $places;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


}