<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:25
 */
class ModelCompanyFeatured extends dbConnection
{
    private $companyFeaturedId;
    private $companySegmentId;
    private $companyId;
    private $geoCityId;
    private $companyFeaturedOrder;

    /**
     * @return mixed
     */
    public function getCompanyFeaturedId()
    {
        return $this->companyFeaturedId;
    }

    /**
     * @param mixed $companyFeaturedId
     */
    public function setCompanyFeaturedId($companyFeaturedId)
    {
        $this->companyFeaturedId = $companyFeaturedId;
    }

    /**
     * @return mixed
     */
    public function getCompanySegmentId()
    {
        return $this->companySegmentId;
    }

    /**
     * @param mixed $companySegmentId
     */
    public function setCompanySegmentId($companySegmentId)
    {
        $this->companySegmentId = $companySegmentId;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param mixed $companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
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

    /**
     * @return mixed
     */
    public function getCompanyFeaturedOrder()
    {
        return $this->companyFeaturedOrder;
    }

    /**
     * @param mixed $companyFeaturedOrder
     */
    public function setCompanyFeaturedOrder($companyFeaturedOrder)
    {
        $this->companyFeaturedOrder = $companyFeaturedOrder;
    }


}