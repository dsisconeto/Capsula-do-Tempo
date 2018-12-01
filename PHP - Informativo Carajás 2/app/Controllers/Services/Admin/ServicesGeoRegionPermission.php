<?php

namespace App\Controllers\Services\Admin;

use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;

use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;


class ServicesGeoRegionPermission
{


    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"));
    }

    public function select2()
    {
        $regionPermission = new RegionUserPermission();
        $cri = new Criteria();
        $geoRegionName = Request::get("geo_region_name", "str", "");
        $cri->add(new Filter("geo_region_name", "LIKE", "%$geoRegionName%"));
        $cri->add(new Filter("system_user_id_fk", "=", Login::user()->getId()));
        $col[] = "geo_region_id";
        $col[] = "geo_region_name";
        $arg["id"] = "geo_region_id";
        $arg["text"] = "geo_region_name";

        DataFormat::select2($regionPermission->select($cri, $col), $arg);

    }

    public function searchRegion()
    {

        $name = Request::get("geo_region_name", "str", "");
        $level = Request::get("geo_region_level", "int", 0);
        $permission = Request::get("permission", "str", "");


        $regionPermission = new RegionUserPermission();

        $res = $regionPermission->searchRegion($name, $permission, $level);
        $arg["id"] = "geo_region_id";
        $arg["text"] = "geo_region_name";

        return DataFormat::select2($res, $arg);
    }

    public function selectPermissionByUser()
    {
        $regionPermission = new RegionUserPermission();
        $regionName = Request::get("geo_region_name", "str", "");
        $userId = Request::get("system_user_id", "int", 0);

        return $regionPermission->selectPermissionByUser($userId, $regionName);
    }


}