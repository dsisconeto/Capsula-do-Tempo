<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 13/10/16
 * Time: 20:59
 */
sysLoadClass("GeoRegionUserPermission");

class AdminServicesGeoRegionPermission
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();
        if (!$login->validateLogIn()) {
            exit();
        }
    }

    public function select2()
    {
        $login = SystemLogin::getLogin();
        $regionPermission = new GeoRegionUserPermission();
        $cri = new Criteria();
        $geoRegionName = DjRequest::get("geo_region_name", "str", "");
        $cri->add(new Filter("geo_region_name", "LIKE", "%$geoRegionName%"));
        $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));
        $col[] = "geo_region_id";
        $col[] = "geo_region_name";
        $arg["id"] = "geo_region_id";
        $arg["text"] = "geo_region_name";

        DjWork::select2($regionPermission->sqlSelect($cri, $col), $arg);

    }

    public function searchRegion()
    {

        $name = DjRequest::get("geo_region_name", "str", "");
        $level = DjRequest::get("geo_region_level", "int", 0);
        $permission = DjRequest::get("permission", "str", "");




        $regionPermission = new GeoRegionUserPermission();

        $res  =  $regionPermission->searchRegion($name, $permission, $level);
        $arg["id"] = "geo_region_id";
        $arg["text"] = "geo_region_name";

        DjWork::select2($res, $arg);



    }

    public function selectPermissionByUser()
    {
        $regionPermission = new GeoRegionUserPermission();
        $regionName = DjRequest::get("geo_region_name", "str", "");
        $userId = DjRequest::get("system_user_id", "int", 0);

        return $regionPermission->selectPermissionByUser($userId, $regionName);
    }


}