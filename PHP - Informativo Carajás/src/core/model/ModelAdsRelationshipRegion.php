<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/05/16
 * Time: 20:47
 */
class ModelAdsRelationshipRegion extends dbConnection
{

    private $adsId;
    private $geoRegionId;
    private $systemUserId;
    private $adsRelationshipRegionDateInsert;

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
    public function getSystemUserId()
    {
        return $this->systemUserId;
    }

    /**
     * @param mixed $systemUserId
     */
    public function setSystemUserId($systemUserId)
    {
        $this->systemUserId = $systemUserId;
    }

    /**
     * @return mixed
     */
    public function getAdsRelationshipRegionDateInsert()
    {
        return $this->adsRelationshipRegionDateInsert;
    }

    /**
     * @param mixed $adsRelationshipRegionDateInsert
     */
    public function setAdsRelationshipRegionDateInsert($adsRelationshipRegionDateInsert)
    {
        $this->adsRelationshipRegionDateInsert = $adsRelationshipRegionDateInsert;
    }


    

}