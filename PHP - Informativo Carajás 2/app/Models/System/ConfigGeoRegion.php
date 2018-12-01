<?php

namespace App\Models\System;

use App\Models\Geo\Region;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\Request;

class ConfigGeoRegion extends Model
{

    private static $systemConfig;
    private $id;
    private $companyView;
    private $eventView;
    private $newspaperView;

    public function __construct()
    {
        $this->setTable("system_config_geo_region");
        $this->setPrimaryKey("geo_region_id_fk");

    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("geo_region_id_fk", $this->getId());
        $sql->setRowData("company_view", $this->getCompanyView());
        $sql->setRowData("event_view", $this->getEventView());
        $sql->setRowData("newspaper_view", $this->getNewspaperView());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));

        $sql->setRowData("company_view", $this->getCompanyView());
        $sql->setRowData("event_view", $this->getEventView());
        $sql->setRowData("newspaper_view", $this->getNewspaperView());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {

            $res = $res[0];
            $this->setId($res["geo_region_id_fk"]);
            $this->setCompanyView($res["company_view"]);
            $this->setEventView($res["event_view"]);
            $this->setNewspaperView($res["newspaper_view"]);

        }

        return $res;
    }


    public static function getSystemConfig($regionId = false, $reload = false)
    {
        if (self::$systemConfig && !$reload) {

            return self::$systemConfig;

        } else {

            if (!$regionId) {

                $regionId = Region::define();

            }

            $systemConfig = new ConfigGeoRegion();
            $systemConfig->load($regionId);


            self::$systemConfig = $systemConfig;

            return self::$systemConfig;
        }

    }

    public static function validate($col = false, $geoRegionId = false)
    {
        $systemConfig = new ConfigGeoRegion();

        if (!$geoRegionId) {

            $geoRegionId = Region::define();
        }

        $res = $systemConfig->load($geoRegionId);

        if ($col) {

            switch ($col) {

                case"event":
                    $col = "event_view";
                    break;


                case"company":
                    $col = "company_view";
                    break;


                case"newspaper":
                    $col = "newspaper_view";
                    break;


            }

            return (($res) && (isset($res[$col])) && $res[$col]);
        } else {
            return $res;
        }


    }


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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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