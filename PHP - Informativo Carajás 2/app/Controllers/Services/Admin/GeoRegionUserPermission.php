<?php

namespace App\Controllers\Services\Admin;

use App\Models\Geo\RegionUserPermission;

use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;
use App\Models\User\Login;


class GeoRegionUserPermission
{
    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"));

    }

    public function search()
    {

        $regionName = Request::get("geo_region_name");
        $permission = Request::get("permission");
        $permissionUser = New RegionUserPermission();

        DataFormat::select2($permissionUser->searchRegion($regionName, $permission), array("id" => "geo_region_id", "text" => "geo_region_name"));
    }


}