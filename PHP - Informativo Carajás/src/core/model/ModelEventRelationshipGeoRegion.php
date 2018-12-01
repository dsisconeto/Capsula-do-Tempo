<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 09/06/2016
 * Time: 02:55
 */
class ModelEventRelationshipGeoRegion extends dbConnection
{

    private $eventIdFk;
    private $geoRegionIdFk;

    /**
     * @return mixed
     */
    public function getEventIdFk()
    {
        return $this->eventIdFk;
    }

    /**
     * @param mixed $eventIdFk
     */
    public function setEventIdFk($eventIdFk)
    {
        $this->eventIdFk = $eventIdFk;
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


}