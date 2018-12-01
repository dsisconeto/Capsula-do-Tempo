<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 11/07/2016
 * Time: 22:40
 */
class ModelCompanyRelationshipGeoRegion extends dbConnection
{
    private $geoRegionIdFk;
    private $companyIdFk;

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
    public function getCompanyIdFk()
    {
        return $this->companyIdFk;
    }

    /**
     * @param mixed $companyIdFk
     */
    public function setCompanyIdFk($companyIdFk)
    {
        $this->companyIdFk = $companyIdFk;
    }
    
    
    

}