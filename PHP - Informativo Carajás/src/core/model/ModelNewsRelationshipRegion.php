<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 13/05/2016
 * Time: 17:44
 */
class ModelNewsRelationshipRegion extends dbConnection
{
    private $newsIdFk;
    private $geoRegionId;

    /**
     * @return mixed
     */
    public function getNewsIdFk()
    {
        return $this->newsIdFk;
    }

    /**
     * @param mixed $newsIdFk
     */
    public function setNewsIdFk($newsIdFk)
    {
        $this->newsIdFk = $newsIdFk;
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

}