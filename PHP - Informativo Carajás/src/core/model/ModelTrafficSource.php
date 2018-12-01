<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 22:05
 */

class ModelTrafficSource extends dbConnection
{

    private $trafficSourceId;
    private $trafficSourceName;
    private $trafficSourceDateInsert;
    private $trafficSourceDateUpdate;

    /**
     * @return mixed
     */
    public function getTrafficSourceId()
    {
        return $this->trafficSourceId;
    }

    /**
     * @param mixed $trafficSourceId
     */
    public function setTrafficSourceId($trafficSourceId)
    {
        $this->trafficSourceId = $trafficSourceId;
    }

    /**
     * @return mixed
     */
    public function getTrafficSourceName()
    {
        return $this->trafficSourceName;
    }

    /**
     * @param mixed $trafficSourceName
     */
    public function setTrafficSourceName($trafficSourceName)
    {
        $this->trafficSourceName = $trafficSourceName;
    }

    /**
     * @return mixed
     */
    public function getTrafficSourceDateInsert()
    {
        return $this->trafficSourceDateInsert;
    }

    /**
     * @param mixed $trafficSourceDateInsert
     */
    public function setTrafficSourceDateInsert($trafficSourceDateInsert)
    {
        $this->trafficSourceDateInsert = $trafficSourceDateInsert;
    }

    /**
     * @return mixed
     */
    public function getTrafficSourceDateUpdate()
    {
        return $this->trafficSourceDateUpdate;
    }

    /**
     * @param mixed $trafficSourceDateUpdate
     */
    public function setTrafficSourceDateUpdate($trafficSourceDateUpdate)
    {
        $this->trafficSourceDateUpdate = $trafficSourceDateUpdate;
    }
    
    
    
}