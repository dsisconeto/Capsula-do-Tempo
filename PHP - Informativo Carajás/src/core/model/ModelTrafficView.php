<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 22:16
 */
class ModelTrafficView extends dbConnection
{
    private $trafficViewId;
    private $trafficSourceId;
    private $trafficUserId;
    private $trafficOsId;
    private $systemUrl;
    private $trafficViewDateInsert;

    /**
     * @return mixed
     */
    public function getTrafficViewId()
    {
        return $this->trafficViewId;
    }

    /**
     * @param mixed $trafficViewId
     */
    public function setTrafficViewId($trafficViewId)
    {
        $this->trafficViewId = $trafficViewId;
    }

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
    public function getTrafficUserId()
    {
        return $this->trafficUserId;
    }

    /**
     * @param mixed $trafficUserId
     */
    public function setTrafficUserId($trafficUserId)
    {
        $this->trafficUserId = $trafficUserId;
    }

    /**
     * @return mixed
     */
    public function getTrafficOsId()
    {
        return $this->trafficOsId;
    }

    /**
     * @param mixed $trafficOsId
     */
    public function setTrafficOsId($trafficOsId)
    {
        $this->trafficOsId = $trafficOsId;
    }

    /**
     * @return mixed
     */
    public function getSystemUrl()
    {
        return $this->systemUrl;
    }

    /**
     * @param mixed $systemUrl
     */
    public function setSystemUrl($systemUrl)
    {
        $this->systemUrl = $systemUrl;
    }

    /**
     * @return mixed
     */
    public function getTrafficViewDateInsert()
    {
        return $this->trafficViewDateInsert;
    }

    /**
     * @param mixed $trafficViewDateInsert
     */
    public function setTrafficViewDateInsert($trafficViewDateInsert)
    {
        $this->trafficViewDateInsert = $trafficViewDateInsert;
    }


}