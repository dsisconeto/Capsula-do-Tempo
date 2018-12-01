<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 18/08/2016
 * Time: 00:40
 */
class ModelSystemConfigGeoRegion extends dbConnection
{

    private $geoRegionIdFk;
    private $companyView;
    private $eventView;
    private $newspaperView;

    /**
     * @return mixed
     */
    public function getNewspaperView()
    {
        return $this->newspaperView;
    }

    /**
     * @param mixed $newspaperView
     */
    public function setNewspaperView($newspaperView)
    {
        $this->newspaperView = $newspaperView;
    }

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


}