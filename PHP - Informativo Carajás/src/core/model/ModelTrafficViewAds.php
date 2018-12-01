<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 22:09
 */
class ModelTrafficViewAds extends dbConnection
{
    private $trafficViewAdsId;
    private $adsId;
    private $userIp;
    private $os;
    private $trafficViewAdsDateInsert;

    /**
     * @return mixed
     */
    public function getTrafficViewAdsId()
    {
        return $this->trafficViewAdsId;
    }

    /**
     * @param mixed $trafficViewAdsId
     */
    public function setTrafficViewAdsId($trafficViewAdsId)
    {
        $this->trafficViewAdsId = $trafficViewAdsId;
    }

    /**
     * @return mixed
     */
    public function getAdsId()
    {
        return $this->adsId;
    }

    /**
     * @param mixed $adsId
     */
    public function setAdsId($adsId)
    {
        $this->adsId = $adsId;
    }

    /**
     * @return mixed
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * @param mixed $userIp
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @return mixed
     */
    public function getTrafficViewAdsDateInsert()
    {
        return $this->trafficViewAdsDateInsert;
    }

    /**
     * @param mixed $trafficViewAdsDateInsert
     */
    public function setTrafficViewAdsDateInsert($trafficViewAdsDateInsert)
    {
        $this->trafficViewAdsDateInsert = $trafficViewAdsDateInsert;
    }


    
    
    
}

   