<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 18/08/2016
 * Time: 00:50
 */
sysLoadClass("ActionSystemConfigGeoRegion");

class SystemConfigGeoRegion extends ActionSystemConfigGeoRegion
{

    private static $systemConfig;


    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public static function getSystemConfig()
    {
        if (self::$systemConfig) {

            return self::$systemConfig;

        } else {
            $systemConfig = new SystemConfigGeoRegion();
            $systemConfig->sqlLoadByGeoRegion(DjRequest::cookie("geo_region_id", "int"));


            self::$systemConfig = $systemConfig;


            return self::$systemConfig;
        }

    }

    public static function validate($col = false)
    {
        $cr = new SystemConfigGeoRegion();

        $res = $cr->sqlLoadByGeoRegion(DjRequest::cookie("geo_region_id"));

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

    public function issetConfig($geoRegionId)
    {


        $criteria = new Criteria();
        $criteria->add(New Filter('geo_region_id_fk', '=', $geoRegionId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        return $res ? true : false;

    }


}