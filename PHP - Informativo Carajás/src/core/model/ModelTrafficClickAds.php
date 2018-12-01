<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 22:03
 */
class ModelTrafficClickAds extends dbConnection
{
    private $trafficClickAdsId;
    private $adsId;
    private $trafficClickAdsUrl;
    private $trafficClickAdsOs;
    private $trafficClickAdsIp;
    private $trafficClickAdsDateInsert;

    /**
     * @return mixed
     */
    public function getTrafficClickAdsId()
    {
        return $this->trafficClickAdsId;
    }

    /**
     * @param mixed $trafficClickAdsId
     */
    public function setTrafficClickAdsId($trafficClickAdsId)
    {
        $this->trafficClickAdsId = $trafficClickAdsId;
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
    public function getTrafficClickAdsUrl()
    {
        return $this->trafficClickAdsUrl;
    }

    /**
     * @param mixed $trafficClickAdsUrl
     */
    public function setTrafficClickAdsUrl($trafficClickAdsUrl)
    {
        $this->trafficClickAdsUrl = $trafficClickAdsUrl;
    }

    /**
     * @return mixed
     */
    public function getTrafficClickAdsOs()
    {
        return $this->trafficClickAdsOs;
    }

    /**
     * @param mixed $trafficClickAdsOs
     */
    public function setTrafficClickAdsOs($trafficClickAdsOs)
    {
        $this->trafficClickAdsOs = $trafficClickAdsOs;
    }

    /**
     * @return mixed
     */
    public function getTrafficClickAdsIp()
    {
        return $this->trafficClickAdsIp;
    }

    /**
     * @param mixed $trafficClickAdsIp
     */
    public function setTrafficClickAdsIp($trafficClickAdsIp)
    {
        $this->trafficClickAdsIp = $trafficClickAdsIp;
    }

    /**
     * @return mixed
     */
    public function getTrafficClickAdsDateInsert()
    {
        return $this->trafficClickAdsDateInsert;
    }

    /**
     * @param mixed $trafficClickAdsDateInsert
     */
    public function setTrafficClickAdsDateInsert($trafficClickAdsDateInsert)
    {
        $this->trafficClickAdsDateInsert = $trafficClickAdsDateInsert;
    }




}