<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/05/16
 * Time: 20:40
 */
class ModelGeoRegionRelationship extends dbConnection
{
    private $geoRegionId;
    private $geoCityId;

    /**
     * @return mixed
     */
    public function getGeoRegionId()
    {
        return $this->geoRegionId;
    }

    /**
     * @param mixed $geoRegionId
     */
    public function setGeoRegionId($geoRegionId)
    {
        $this->geoRegionId = $geoRegionId;
    }

    /**
     * @return mixed
     */
    public function getGeoCityId()
    {
        return $this->geoCityId;
    }

    /**
     * @param mixed $geoCityId
     */
    public function setGeoCityId($geoCityId)
    {
        $this->geoCityId = $geoCityId;
    }
    
}