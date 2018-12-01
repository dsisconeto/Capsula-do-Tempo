<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 29/05/2016
 * Time: 16:22
 */
class ModelCompanyRelationshipFeatured extends dbConnection
{
    private $companyRelationshipFeaturedId;
    private $companyIdFk;
    private $companyFeaturedIdFk;
    private $geoRegionIdFk;
    private $companyRelationshipFeaturedOrder;

    /**
     * @return mixed
     */
    public function getCompanyRelationshipFeaturedId()
    {
        return $this->companyRelationshipFeaturedId;
    }

    /**
     * @param mixed $companyRelationshipFeaturedId
     */
    public function setCompanyRelationshipFeaturedId($companyRelationshipFeaturedId)
    {
        $this->companyRelationshipFeaturedId = $companyRelationshipFeaturedId;
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

    /**
     * @return mixed
     */
    public function getCompanyFeaturedIdFk()
    {
        return $this->companyFeaturedIdFk;
    }

    /**
     * @param mixed $companyFeaturedIdFk
     */
    public function setCompanyFeaturedIdFk($companyFeaturedIdFk)
    {
        $this->companyFeaturedIdFk = $companyFeaturedIdFk;
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
    public function getCompanyRelationshipFeaturedOrder()
    {
        return $this->companyRelationshipFeaturedOrder;
    }

    /**
     * @param mixed $companyRelationshipFeaturedOrder
     */
    public function setCompanyRelationshipFeaturedOrder($companyRelationshipFeaturedOrder)
    {
        $this->companyRelationshipFeaturedOrder = $companyRelationshipFeaturedOrder;
    }

}