<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 10/05/16
 * Time: 01:25
 */
class ModelGeoRegionRelationshipParent extends dbConnection
{

    private $geoRegionId;
    private $geoRegionIdParent;

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
    public function getGeoRegionIdParent()
    {
        return $this->geoRegionIdParent;
    }

    /**
     * @param mixed $geoRegionIdParent
     */
    public function setGeoRegionIdParent($geoRegionIdParent)
    {
        $this->geoRegionIdParent = $geoRegionIdParent;
    }
    
    
    
}