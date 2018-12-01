<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 20/07/2016
 * Time: 14:12
 */
class ModelSystem extends dbConnection
{
    private $geoRegionIdFk;
    private $eventView;
    private $companyView;

    /**
     * @return mixed
     */
    public function getGeoRegionIdFk()
    {
        return $this->geoRegionIdFk;
    }

    /**
     * @param mixed $geoRegionIdFk
     */
    public function setGeoRegionIdFk($geoRegionIdFk)
    {
        $this->geoRegionIdFk = $geoRegionIdFk;
    }

    /**
     * @return mixed
     */
    public function getEventView()
    {
        return $this->eventView;
    }

    /**
     * @param mixed $eventView
     */
    public function setEventView($eventView)
    {
        $this->eventView = $eventView;
    }

    /**
     * @return mixed
     */
    public function getCompanyView()
    {
        return $this->companyView;
    }

    /**
     * @param mixed $companyView
     */
    public function setCompanyView($companyView)
    {
        $this->companyView = $companyView;
    }

}