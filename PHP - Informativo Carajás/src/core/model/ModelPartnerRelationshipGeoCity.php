<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 20:06
 */
class ModelPartnerRelationshipGeoCity extends dbConnection
{
    private $partnerId;
    private $geoCityId;

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @param mixed $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = $partnerId;
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