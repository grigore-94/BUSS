<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/22/2017
 * Time: 1:17 PM
 */

namespace Bs\AppBundle\Models;

class SearchRoute
{
    private $from;
    private $to;
    private $atDate;
    private $atTime;

    /**
     * @return mixed
     */
    public function getAtTime()
    {
        return $this->atTime;
    }

    /**
     * @param mixed $atTime
     */
    public function setAtTime($atTime)
    {
        $this->atTime = $atTime;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getAtDate()
    {
        return $this->atDate;
    }

    /**
     * @param mixed $atDate
     */
    public function setAtDate($atDate)
    {
        $this->atDate = $atDate;
    }
}